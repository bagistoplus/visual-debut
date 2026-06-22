<?php

namespace BagistoPlus\VisualDebut;

if (! function_exists('_t')) {
    /**
     * A shortcut for visual-debut string localization
     * Works with both sections and blocks translations
     */
    function _t(string $key): string
    {
        return \BagistoPlus\Visual\t("visual-debut::$key");
    }
}
