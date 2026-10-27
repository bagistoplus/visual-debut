<?php

use BagistoPlus\VisualDebut\Support\BuildsCarouselConfig;
use Illuminate\Support\Fluent;

function carouselConfig(array $settings): array
{
    $section = new class
    {
        use BuildsCarouselConfig;

        public object $section;

        public function config(): array
        {
            return $this->buildCarouselConfig();
        }
    };

    $section->section = (object) ['settings' => new Fluent(['layout_type' => 'carousel', ...$settings])];

    return $section->config();
}

it('has no carousel attributes for a grid', function () {
    expect(carouselConfig(['layout_type' => 'grid']))->toBe([]);
});

it('spaces the slides per device, a phone falling back to the tablet and the tablet to the default', function () {
    expect(carouselConfig(['columns' => 4, 'gap' => ['_default' => 6, 'mobile' => 4]]))
        ->toMatchArray([
            'spacing' => '16px 640:24px 1024:24px',
            'spacing-desktop' => '24px',
            'spacing-tablet' => null,
            'spacing-mobile' => '16px',
        ])
        ->and(carouselConfig(['columns' => 4, 'gap' => ['_default' => 6, 'tablet' => 5]])['spacing'])
        ->toBe('20px 640:20px 1024:24px');
});

it('keeps a single gap saved before it was set per device', function () {
    expect(carouselConfig(['columns' => 4, 'gap' => 3]))
        ->toMatchArray([
            'spacing' => '12px 640:12px 1024:12px',
            'spacing-desktop' => '12px',
            'spacing-tablet' => null,
            'spacing-mobile' => null,
        ]);
});
