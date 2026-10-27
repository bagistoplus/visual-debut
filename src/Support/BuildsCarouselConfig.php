<?php

namespace BagistoPlus\VisualDebut\Support;

use BagistoPlus\BasicBlocks\Tailwind;

/**
 * The carousel attributes of a section with a carousel layout, from its columns and gap.
 */
trait BuildsCarouselConfig
{
    /**
     * @return array<string, mixed>
     */
    protected function buildCarouselConfig(): array
    {
        $settings = $this->section->settings;

        if ($settings->layout_type !== 'carousel') {
            return [];
        }

        // Desktop first, like the grid layout's mobile:/tablet: classes: tablet falls back to
        // the default, mobile to tablet. The tiers use the same widths as those variants.
        [$perPage, $perPageTablet, $perPageMobile] = $this->deviceValues($settings->columns ?? 4);
        [$gap, $gapTablet, $gapMobile] = $this->deviceValues($settings->gap ?? 4);

        $tablet = $perPageTablet ?? $perPage;
        $mobile = $perPageMobile ?? $tablet;

        $spacingTablet = ($gapTablet ?? $gap) * 4;
        $spacingMobile = ($gapMobile ?? $gapTablet ?? $gap) * 4;

        $autoplay = (bool) ($settings->autoplay ?? false);

        return [
            'slides-per-page' => "{$mobile} 640:{$tablet} 1024:{$perPage}",
            'per-page' => $perPage,
            'per-page-tablet' => $perPageTablet,
            'per-page-mobile' => $perPageMobile,
            'spacing' => "{$spacingMobile}px 640:{$spacingTablet}px 1024:".($gap * 4).'px',
            'spacing-desktop' => ($gap * 4).'px',
            'spacing-tablet' => $gapTablet === null ? null : ($gapTablet * 4).'px',
            'spacing-mobile' => $gapMobile === null ? null : ($gapMobile * 4).'px',
            'loop' => $autoplay || (bool) ($settings->loop ?? false),
            'autoplay' => $autoplay,
            'autoplay-delay' => (int) ($settings->autoplay_delay ?? 3000),
        ];
    }

    /**
     * The default value of a responsive setting, and its tablet and mobile values when set.
     *
     * @return array{int, int|null, int|null}
     */
    private function deviceValues(mixed $value): array
    {
        $values = Tailwind::toResponsiveValue($value);

        return [
            (int) $values->value(),
            $values->has('tablet') ? (int) $values->get('tablet') : null,
            $values->has('mobile') ? (int) $values->get('mobile') : null,
        ];
    }
}
