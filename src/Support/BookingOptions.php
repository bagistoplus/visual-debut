<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Webkul\BookingProduct\Helpers\Booking as BookingHelper;
use Webkul\Core\Core;

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
    public const SUPPORTED = ['default', 'appointment', 'event', 'table'];

    /**
     * The booking types whose form sets the quantity, so the page hides its
     * quantity selector for them.
     */
    public const OWN_QUANTITY = ['event', 'table'];

    /**
     * The form settings for a booking product, or null when the product is
     * not one the page can book.
     */
    public static function for(object $product): ?array
    {
        $bookingProduct = self::bookingProduct($product);

        if (! $bookingProduct || ! in_array($bookingProduct->type, self::SUPPORTED, true)) {
            return null;
        }

        $settings = match ($bookingProduct->type) {
            'event' => self::event($product, $bookingProduct),
            'table' => self::table($product, $bookingProduct),
            default => self::slots($bookingProduct),
        };

        if ($settings === null) {
            return null;
        }

        return array_merge([
            'type' => $bookingProduct->type,
            'location' => $bookingProduct->location ?: null,
            'cancellable' => $bookingProduct->allow_cancellation ?? true,
        ], $settings);
    }

    /**
     * Whether the booking form sets the quantity instead of the page's
     * quantity selector.
     */
    public static function ownsQuantity(object $product): bool
    {
        $bookingProduct = self::bookingProduct($product);

        return $bookingProduct !== null && in_array($bookingProduct->type, self::OWN_QUANTITY, true);
    }

    private static function bookingProduct(object $product): ?object
    {
        if ($product->type !== 'booking') {
            return null;
        }

        return $product->getTypeInstance()->getBookingProduct($product->id) ?: null;
    }

    /**
     * A default or appointment booking: one slot on one day.
     */
    private static function slots(object $bookingProduct): ?array
    {
        $slot = self::slotSettings($bookingProduct);

        if (! $slot) {
            return null;
        }

        // A default booking for many days is one slot; without it the slots repeat every week
        $repeatsWeekly = $bookingProduct->type !== 'default' || $slot->booking_type === 'many';
        $everyWeek = (bool) $bookingProduct->available_every_week;

        return [
            'slotsUrl' => route(self::slotsRouteName(), $bookingProduct->id),
            'availableFrom' => $everyWeek ? null : self::date($bookingProduct->available_from),
            'availableTo' => $everyWeek ? null : self::date($bookingProduct->available_to),
            'duration' => $repeatsWeekly && $slot->duration ? (int) $slot->duration : null,
            'openingHours' => $repeatsWeekly ? self::openingHours($bookingProduct) : self::periods($slot),
            'preventDays' => 0,
        ];
    }

    /**
     * A table: a slot on one day for a party, charged per guest or per table
     * of up to a number of guests. Bagisto takes the party as the quantity.
     */
    private static function table(object $product, object $bookingProduct): ?array
    {
        $settings = self::slots($bookingProduct);
        $table = $bookingProduct->table_slot;

        if ($settings === null) {
            return null;
        }

        return array_merge($settings, [
            'preventDays' => (int) ($table->prevent_scheduling_before ?? 0),
            'perTable' => $table->price_type === 'table',
            'guestLimit' => (int) ($table->guest_limit ?? 0),
            'price' => self::converted((float) $product->getTypeInstance()->getFinalPrice()),
        ]);
    }

    /**
     * An event: tickets bought by the number, each charged its own price on
     * top of the product's. Prices are in the shop's currency.
     */
    private static function event(object $product, object $bookingProduct): array
    {
        return [
            'startsAt' => self::moment($bookingProduct->available_from),
            'endsAt' => self::moment($bookingProduct->available_to),
            'basePrice' => self::converted((float) $product->getTypeInstance()->getFinalPrice()),
            'tickets' => collect($bookingProduct->event_tickets ?? [])
                ->map(function (object $ticket) {
                    $special = self::specialPrice($ticket);

                    return [
                        'id' => (int) $ticket->id,
                        'name' => (string) $ticket->name,
                        'description' => (string) ($ticket->description ?? ''),
                        'price' => self::converted($special ?? (float) $ticket->price),
                        'regularPrice' => $special === null ? null : self::converted((float) $ticket->price),
                    ];
                })
                ->values()
                ->all(),
        ];
    }

    /**
     * A ticket's sale price while it runs, as Bagisto's `isInSale()` reads it.
     */
    private static function specialPrice(object $ticket): ?float
    {
        $special = (float) ($ticket->special_price ?? 0);

        if ($special <= 0) {
            return null;
        }

        $now = Carbon::now();
        $from = self::saleDate($ticket->special_price_from ?? null);
        $to = self::saleDate($ticket->special_price_to ?? null);

        if (($from && $from > $now) || ($to && $to <= $now)) {
            return null;
        }

        return $special;
    }

    /**
     * Bagisto stores a missing sale date as null or as a zero date.
     */
    private static function saleDate(mixed $value): ?Carbon
    {
        if (! $value || $value === '0000-00-00 00:00:00') {
            return null;
        }

        return Carbon::parse($value);
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
            'table' => $bookingProduct->table_slot,
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

    /**
     * A price in the base currency, in the shop's current currency.
     */
    private static function converted(float $price): float
    {
        return (float) app(Core::class)->convertPrice($price);
    }

    private static function moment(mixed $value): ?string
    {
        return $value ? Carbon::parse($value)->translatedFormat('d M Y, h:i A') : null;
    }

    private static function date(mixed $value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
