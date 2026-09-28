<?php

namespace BagistoPlus\VisualDebut\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

/**
 * A bare application: no theme, no Bagisto. The pieces tested here are plain
 * PHP with fakeable inputs, and the feature they belong to is checked in a
 * browser against a real store.
 */
abstract class TestCase extends Orchestra
{
    protected function defineEnvironment($app): void
    {
        // Laravel defaults the cache to the database store, which this suite
        // has no table for.
        $app['config']->set('cache.default', 'array');
    }
}
