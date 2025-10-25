<?php

namespace BagistoPlus\VisualDebut;

if (! function_exists('_t')) {
    /**
     * A shortcut for visual-debut string localization
     * Works with both sections and blocks translations
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function _t(string $key, array $replace = [], ?string $locale = null): string
    {
        return __("visual-debut::$key", $replace, $locale);
    }
}
