<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheProfile;

class FullPageCache
{
    /**
     * Whether the response to this request will be stored by Bagisto's Full Page Cache.
     *
     * Views that carry per-visitor content ask this before deciding whether to emit a replacer
     * marker instead of the real value. Bagisto's own flash-group view checks only the env flag
     * and the route middleware, which leaves a marker nothing will replace whenever the setting
     * in Configure → Cache Management is off, silently dropping the message. Asking the cache
     * profile covers that setting as well.
     */
    public static function willCache(Request $request): bool
    {
        if (! config('responsecache.enabled')) {
            return false;
        }

        if (! app()->bound(CacheProfile::class)) {
            return false;
        }

        $route = $request->route();

        if (! $route || ! in_array('cache.response', $route->gatherMiddleware(), true)) {
            return false;
        }

        $profile = app(CacheProfile::class);

        return $profile->enabled($request)
            && $profile->shouldCacheRequest($request);
    }
}
