<?php

namespace BagistoPlus\VisualDebut\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MigrateBasicBlocks extends Command
{
    protected $signature = 'visual-debut:migrate-basic-blocks
        {--path=* : Custom JSON file or directory path to migrate}
        {--dry-run : Report changed files without writing them}';

    protected $description = 'Rewrite duplicated Visual Debut basic block types to bagistoplus/basic-blocks.';

    private const TYPE_MAP = [
        '@visual-debut/button' => '@basic-blocks/button',
        '@visual-debut/divider' => '@basic-blocks/divider',
        '@visual-debut/heading' => '@basic-blocks/heading',
        '@visual-debut/icon' => '@basic-blocks/icon',
        '@visual-debut/image' => '@basic-blocks/image',
        '@visual-debut/link' => '@basic-blocks/link',
        '@visual-debut/richtext' => '@basic-blocks/richtext',
        '@visual-debut/text' => '@basic-blocks/text',
        '@visual-debut/group' => '@basic-blocks/group',
        '@visual-debut/category-image' => '@basic-blocks/category-image',
        '@visual-debut/category-name' => '@basic-blocks/category-name',
        '@visual-debut/product-image' => '@basic-blocks/product-image',
        '@visual-debut/product-labels' => '@basic-blocks/product-labels',
        '@visual-debut/product-description' => '@basic-blocks/product-description',
        '@visual-debut/product-short-description' => '@basic-blocks/product-short-description',
        '@visual-debut/product-title' => '@basic-blocks/product-title',
        '@visual-debut/flex-section' => '@basic-blocks/flex-section',
    ];

    public function handle(): int
    {
        $paths = $this->option('path') ?: $this->defaultPaths();
        $dryRun = (bool) $this->option('dry-run');
        $changed = 0;

        foreach ($this->jsonFiles($paths) as $path) {
            $original = File::get($path);
            $data = json_decode($original, true);

            if (! is_array($data)) {
                $this->warn("Skipping invalid JSON: {$path}");

                continue;
            }

            $migrated = $this->migrateNode($data);
            $encoded = json_encode($migrated, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            if ($encoded === false || $encoded.PHP_EOL === $original || $encoded === $original) {
                continue;
            }

            $changed++;
            $this->line(($dryRun ? 'Would update ' : 'Updated ').$path);

            if (! $dryRun) {
                File::put($path, $encoded.PHP_EOL);
            }
        }

        $this->info(($dryRun ? 'Files needing migration: ' : 'Migrated files: ').$changed);

        return self::SUCCESS;
    }

    private function defaultPaths(): array
    {
        $dataPath = config('bagisto-visual.data_path', storage_path('bagisto-visual'));
        $base = rtrim($dataPath, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'visual-debut';

        return [
            $base.DIRECTORY_SEPARATOR.'editor',
            $base.DIRECTORY_SEPARATOR.'live',
            $base.DIRECTORY_SEPARATOR.'versions',
        ];
    }

    private function jsonFiles(array $paths): array
    {
        $files = [];

        foreach ($paths as $path) {
            if (File::isFile($path) && str_ends_with($path, '.json')) {
                $files[] = $path;

                continue;
            }

            if (! File::isDirectory($path)) {
                continue;
            }

            foreach (File::allFiles($path) as $file) {
                if ($file->getExtension() === 'json') {
                    $files[] = $file->getPathname();
                }
            }
        }

        return $files;
    }

    private function migrateNode(mixed $node): mixed
    {
        if (! is_array($node)) {
            return $node;
        }

        $type = is_string($node['type'] ?? null) ? $node['type'] : null;

        if ($type && isset(self::TYPE_MAP[$type])) {
            $node['type'] = self::TYPE_MAP[$type];
        }

        foreach (['properties', 'settings'] as $key) {
            if (isset($node[$key]) && is_array($node[$key])) {
                $node[$key] = $this->migrateSettings($node[$key], $type);
            }
        }

        foreach ($node as $key => $value) {
            if ($key === 'properties' || $key === 'settings') {
                continue;
            }

            if (is_array($value)) {
                $node[$key] = $this->migrateNode($value);
            }
        }

        return $node;
    }

    private function migrateSettings(array $settings, ?string $type): array
    {
        if ($type === '@visual-debut/button') {
            $settings = $this->migrateButtonSettings($settings);
        }

        if (in_array($type, ['@visual-debut/text', '@visual-debut/richtext'], true)) {
            $settings = $this->migrateTextSettings($settings);
        }

        if (in_array($type, ['@visual-debut/group', '@visual-debut/flex-section'], true)) {
            $settings = $this->migrateFlexSettings($settings);
        }

        return $settings;
    }

    private function migrateButtonSettings(array $settings): array
    {
        if (array_key_exists('label', $settings) && ! array_key_exists('text', $settings)) {
            $settings['text'] = $settings['label'];
        }

        if (array_key_exists('link', $settings) && ! array_key_exists('url', $settings)) {
            $settings['url'] = $settings['link'];
        }

        if (array_key_exists('style_class', $settings) && ! array_key_exists('style', $settings)) {
            $settings['style'] = match ($settings['style_class']) {
                'button', 'solid', 'filled' => 'filled',
                'outline' => 'outline',
                'link' => 'link',
                'soft' => 'soft',
                'ghost' => 'ghost',
                default => 'filled',
            };
        }

        if (array_key_exists('block', $settings) && ! array_key_exists('full_width', $settings)) {
            $settings['full_width'] = $settings['block'];
        }

        if (isset($settings['color']) && ! in_array($settings['color'], ['primary', 'secondary', 'accent', 'neutral'], true)) {
            unset($settings['color']);
        }

        foreach (['label', 'link', 'style_class', 'block', 'circle', 'square', 'width', 'custom_width', 'width_mobile', 'custom_width_mobile'] as $key) {
            unset($settings[$key]);
        }

        return $settings;
    }

    private function migrateTextSettings(array $settings): array
    {
        if (array_key_exists('width', $settings)) {
            $settings['width'] = $this->mapResponsiveValue($settings['width'], fn ($value) => match ($value) {
                'fit-content' => 'fit',
                '100%' => 'fill',
                default => $value,
            });
        }

        return $settings;
    }

    private function migrateFlexSettings(array $settings): array
    {
        $settings = $this->migrateFlexPair(
            settings: $settings,
            target: 'flex_justify',
            vertical: 'vertical_justify_content',
            horizontal: 'horizontal_justify_content',
            legacy: 'justify_content'
        );

        $settings = $this->migrateFlexPair(
            settings: $settings,
            target: 'flex_align',
            vertical: 'vertical_align_items',
            horizontal: 'horizontal_align_items',
            legacy: 'align_items'
        );

        return $settings;
    }

    private function migrateFlexPair(array $settings, string $target, string $vertical, string $horizontal, string $legacy): array
    {
        if (! array_key_exists($target, $settings)) {
            if (array_key_exists($vertical, $settings) || array_key_exists($horizontal, $settings)) {
                $settings[$target] = $this->selectByFlexDirection(
                    $settings['flex_direction'] ?? 'column',
                    $settings[$vertical] ?? null,
                    $settings[$horizontal] ?? null
                );
            } elseif (array_key_exists($legacy, $settings)) {
                $settings[$target] = $settings[$legacy];
            }
        }

        unset($settings[$vertical], $settings[$horizontal], $settings[$legacy]);

        return $settings;
    }

    private function selectByFlexDirection(mixed $direction, mixed $vertical, mixed $horizontal): mixed
    {
        if (! is_array($direction)) {
            return str_starts_with((string) $direction, 'row') ? ($horizontal ?? $vertical) : ($vertical ?? $horizontal);
        }

        $result = [];
        foreach ($direction as $breakpoint => $value) {
            $source = str_starts_with((string) $value, 'row') ? $horizontal : $vertical;
            $fallback = $source ?? $vertical ?? $horizontal;
            $result[$breakpoint] = $this->responsiveValueAt($fallback, $breakpoint);
        }

        return $result;
    }

    private function responsiveValueAt(mixed $value, string|int $breakpoint): mixed
    {
        if (! is_array($value)) {
            return $value;
        }

        return $value[$breakpoint] ?? $value['_default'] ?? reset($value);
    }

    private function mapResponsiveValue(mixed $value, callable $mapper): mixed
    {
        if (! is_array($value)) {
            return $mapper($value);
        }

        return array_map(fn ($item) => $this->mapResponsiveValue($item, $mapper), $value);
    }
}
