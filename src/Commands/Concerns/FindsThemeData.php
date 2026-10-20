<?php

namespace BagistoPlus\VisualDebut\Commands\Concerns;

use Illuminate\Support\Facades\File;

/**
 * Finds the JSON files Bagisto Visual saved for this theme (the editor draft,
 * the published live data and every kept version) and writes them back in
 * the layout they had.
 */
trait FindsThemeData
{
    private function defaultPaths(): array
    {
        $dataPath = config('bagisto_visual.data_path', storage_path('bagisto-visual'));
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

    /**
     * Encodes the data in the layout the file had: pretty printed by a person
     * or minified by the editor.
     */
    private function encode(array $data, string $original): string
    {
        $flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

        if (str_contains(trim($original), "\n")) {
            return json_encode($data, $flags | JSON_PRETTY_PRINT).PHP_EOL;
        }

        return json_encode($data, $flags);
    }
}
