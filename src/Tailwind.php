<?php

namespace BagistoPlus\VisualDebut;

use Craftile\Core\Data\ResponsiveValue;

class Tailwind
{
    protected static array $breakpointMap = [
        'mobile' => 'mobile',
        'tablet' => 'tablet',
        'desktop' => 'desktop',
        '_default' => '', // base
    ];

    /**
     * Build responsive Tailwind classes from a value and callback
     */
    public static function responsive($value, $callback): string
    {
        $rv = static::toResponsiveValue($value);
        $classes = [];

        foreach ($rv->all() as $key => $v) {
            if ($v === null) {
                continue;
            }

            // Handle callable map or lookup map
            if (is_callable($callback)) {
                $cls = $callback($v);
            } elseif (is_array($callback) && (is_string($v) || is_int($v))) {
                $cls = $callback[$v] ?? (string)$v;
            } else {
                $cls = (string)$v;
            }

            $prefix = static::$breakpointMap[$key] ?? '';
            $classes[] = $prefix ? "{$prefix}:{$cls}" : $cls;
        }

        return implode(' ', $classes);
    }

    protected static function toResponsiveValue($value): ResponsiveValue
    {
        if ($value instanceof ResponsiveValue) {
            return $value;
        }

        // If it's already an array with responsive keys, use it directly
        if (is_array($value) && isset($value['_default'])) {
            return new ResponsiveValue($value);
        }

        // Otherwise wrap the scalar value
        return new ResponsiveValue(['_default' => $value]);
    }
}
