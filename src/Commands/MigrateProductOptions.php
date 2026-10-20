<?php

namespace BagistoPlus\VisualDebut\Commands;

use BagistoPlus\VisualDebut\Commands\Concerns\FindsThemeData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Moves saved templates from the five product type blocks to the one Product
 * Options block, which is the only one that offers booking products.
 *
 * Under each parent, the first enabled old block becomes the options block
 * and the others are removed. A file that inherits from another (an editor
 * draft with a `parent`) only holds part of its blocks, so it is left alone:
 * the old blocks still render there.
 */
class MigrateProductOptions extends Command
{
    use FindsThemeData;

    protected $signature = 'visual-debut:migrate-product-options
        {--path=* : Custom JSON file or directory path to migrate}
        {--dry-run : Report changed files without writing them}';

    protected $description = 'Replace the Visual Debut product type option blocks with the Product Options block.';

    public const OPTIONS_TYPE = '@visual-debut/product-options';

    public const OLD_TYPES = [
        '@visual-debut/product-variant-picker',
        '@visual-debut/product-grouped-options',
        '@visual-debut/product-bundle-options',
        '@visual-debut/product-downloadable-options',
        '@visual-debut/product-customizable-options',
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

            if (isset($data['parent'])) {
                if ($this->hasOldBlocks($data)) {
                    $this->warn("Skipping {$path}: it inherits from another file. Save it again from the editor.");
                }

                continue;
            }

            $migrated = self::migrate($data);

            if ($migrated === $data) {
                continue;
            }

            $changed++;
            $this->line(($dryRun ? 'Would update ' : 'Updated ').$path);

            if (! $dryRun) {
                File::put($path, $this->encode($migrated, $original));
            }
        }

        $this->info(($dryRun ? 'Files needing migration: ' : 'Migrated files: ').$changed);

        return self::SUCCESS;
    }

    /**
     * The saved data with its old product type blocks replaced.
     */
    public static function migrate(array $data): array
    {
        if (! is_array($data['blocks'] ?? null)) {
            return $data;
        }

        $blocks = $data['blocks'];
        $removed = [];

        foreach (self::oldBlocksByParent($blocks) as $parentId => $ids) {
            $siblings = $blocks[$parentId]['children'] ?? null;

            if (is_array($siblings)) {
                $ids = array_values(array_intersect($siblings, $ids)) ?: $ids;
            }

            $keeper = self::firstEnabled($blocks, $ids);

            $blocks[$keeper]['type'] = self::OPTIONS_TYPE;
            $blocks[$keeper]['properties'] = array_intersect_key($blocks[$keeper]['properties'] ?? [], ['product' => true]);

            $removed = array_merge($removed, array_diff($ids, [$keeper]));
        }

        if ($removed === []) {
            $data['blocks'] = $blocks;

            return $data;
        }

        // A removed id left in any list would point at nothing
        foreach ($removed as $id) {
            unset($blocks[$id]);
        }

        foreach ($blocks as $id => $block) {
            if (is_array($block['children'] ?? null)) {
                $blocks[$id]['children'] = array_values(array_diff($block['children'], $removed));
            }
        }

        foreach ($data['regions'] ?? [] as $index => $region) {
            if (is_array($region['blocks'] ?? null)) {
                $data['regions'][$index]['blocks'] = array_values(array_diff($region['blocks'], $removed));
            }
        }

        $data['blocks'] = $blocks;

        return $data;
    }

    /**
     * @return array<string, array<int, string>>
     */
    private static function oldBlocksByParent(array $blocks): array
    {
        $groups = [];

        foreach ($blocks as $id => $block) {
            if (is_array($block) && in_array($block['type'] ?? null, self::OLD_TYPES, true)) {
                $groups[(string) ($block['parentId'] ?? '')][] = (string) $id;
            }
        }

        return $groups;
    }

    private static function firstEnabled(array $blocks, array $ids): string
    {
        foreach ($ids as $id) {
            if (empty($blocks[$id]['disabled'])) {
                return $id;
            }
        }

        return $ids[0];
    }

    private function hasOldBlocks(array $data): bool
    {
        return self::oldBlocksByParent(is_array($data['blocks'] ?? null) ? $data['blocks'] : []) !== [];
    }
}
