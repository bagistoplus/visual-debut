<?php

namespace BagistoPlus\VisualDebut;

use Webkul\Core\Core;

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

if (! function_exists('BagistoPlus\VisualDebut\core')) {
    /**
     * Bagisto's own core() helper is declared by its CoreServiceProvider, which
     * the test suite does not register. This one is always autoloaded, and a
     * test can swap the facade root underneath it.
     *
     * @return Core
     */
    function core()
    {
        return \Webkul\Core\Facades\Core::getFacadeRoot();
    }
}
