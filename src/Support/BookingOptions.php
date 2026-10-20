<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Webkul\BookingProduct\Helpers\Booking as BookingHelper;

/**
 * What the product page needs to book a booking product, read from the
 * booking product itself so it works the same on Bagisto 2.3, 2.4 and 2.5.
 *
 * The page may come from the full page cache, so nothing here depends on
 * today: the shopper's browser works out the first bookable day.
 */
class BookingOptions
{
    /**
     * The booking types the product page can book.
     */
    public const SUPPORTED = ['default', 'appointment'];

    /**
     * The form settings for a booking product, or null when the product is
     * not one the page can book.
     */
    public static function for(object $product): ?array
    {
        if ($product->type !== 'booking') {
            return null;
        }

        $bookingProduct = $product->getTypeInstance()->getBookingProduct($product->id);

        if (! $bookingProduct || ! in_array($bookingProduct->type, self::SUPPORTED, true)) {
            return null;
        }

        $slot = self::slotSettings($bookingProduct);

        if (! $slot) {
            return null;
        }

        // A default booking for many days is one slot; without it the slots repeat every week
        $repeatsWeekly = $bookingProduct->type === 'appointment' || $slot->booking_type === 'many';
        $everyWeek = (bool) $bookingProduct->available_every_week;

        return [
            'type' => $bookingProduct->type,
            'slotsUrl' => route(self::slotsRouteName(), $bookingProduct->id),
            'availableFrom' => $everyWeek ? null : self::date($bookingProduct->available_from),
            'availableTo' => $everyWeek ? null : self::date($bookingProduct->available_to),
            'duration' => $repeatsWeekly && $slot->duration ? (int) $slot->duration : null,
            'openingHours' => $repeatsWeekly ? self::openingHours($bookingProduct) : self::periods($slot),
            'location' => $bookingProduct->location ?: null,
            'cancellable' => $bookingProduct->allow_cancellation ?? true,
        ];
    }

    /**
     * Bagisto 2.5 renamed the slots route to snake case.
     */
    public static function slotsRouteName(): string
    {
        return Route::has('shop.booking_product.slots.index')
            ? 'shop.booking_product.slots.index'
            : 'shop.booking-product.slots.index';
    }

    private static function slotSettings(object $bookingProduct): ?object
    {
        return match ($bookingProduct->type) {
            'default' => $bookingProduct->default_slot,
            'appointment' => $bookingProduct->appointment_slot,
            default => null,
        };
    }

    /**
     * Each weekday with its hours, empty when closed.
     *
     * @return array<int, array{name: string, slots: array<int, array{from: string, to: string}>}>
     */
    private static function openingHours(object $bookingProduct): array
    {
        return collect(app(BookingHelper::class)->getWeekSlotDurations($bookingProduct))
            ->map(fn (array $day) => [
                'name' => $day['name'],
                'slots' => collect($day['slots'] ?? [])
                    ->map(fn (array $slot) => ['from' => $slot['from'], 'to' => $slot['to']])
                    ->values()
                    ->all(),
            ])
            ->all();
    }

    /**
     * A default booking for many days lists its periods instead, each from a
     * weekday and time to another: the shopper can only start on those days.
     *
     * @return array<int, array{name: string, slots: array<int, array{from: string, to: string}>}>
     */
    private static function periods(object $slot): array
    {
        return collect($slot->slots ?? [])
            ->filter(fn ($period) => isset($period['from_day'], $period['from'], $period['to_day'], $period['to']))
            ->map(fn (array $period) => [
                'name' => self::weekday((int) $period['from_day']),
                'slots' => [[
                    'from' => self::time($period['from']),
                    'to' => self::weekday((int) $period['to_day']).' '.self::time($period['to']),
                ]],
            ])
            ->values()
            ->all();
    }

    /**
     * A weekday by Bagisto's number for it, 0 being Sunday.
     */
    private static function weekday(int $day): string
    {
        return Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays($day)->translatedFormat('l');
    }

    private static function time(string $time): string
    {
        return Carbon::createFromFormat('H:i', $time)->translatedFormat('h:i A');
    }

    private static function date(mixed $value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
