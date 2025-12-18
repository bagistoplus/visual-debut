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

    /**
     * Build spacing classes from a spacing value object
     *
     * @param object $value Object with top, right, bottom, left properties
     * @param string $prefix Class prefix (p for padding, m for margin)
     * @return string Generated Tailwind classes
     */
    public static function buildSpacingClasses($value, string $prefix): string
    {
        $top = $value->top ?? 0;
        $right = $value->right ?? 0;
        $bottom = $value->bottom ?? 0;
        $left = $value->left ?? 0;

        if ($top == $right && $right == $bottom && $bottom == $left) {
            return $top > 0 ? "{$prefix}-{$top}" : '';
        }

        if ($top == $bottom && $left == $right) {
            $result = [];

            if ($top > 0) {
                $result[] = "{$prefix}y-{$top}";
            }

            if ($left > 0) {
                $result[] = "{$prefix}x-{$left}";
            }

            return implode(' ', $result);
        }

        $result = [];
        if ($top > 0) {
            $result[] = "{$prefix}t-{$top}";
        }

        if ($right > 0) {
            $result[] = "{$prefix}e-{$right}";
        }

        if ($bottom > 0) {
            $result[] = "{$prefix}b-{$bottom}";
        }

        if ($left > 0) {
            $result[] = "{$prefix}s-{$left}";
        }

        return implode(' ', $result);
    }
}
