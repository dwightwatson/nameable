<?php

namespace Watson\Nameable;

use Illuminate\Support\Str as BaseStr;
use Illuminate\Support\Stringable;

class Str extends BaseStr
{
    /**
     * Get the first letter of the given value.
     */
    public static function firstLetter(string $value): string
    {
        return substr($value, 0, 1);
    }

    /**
     * Remove all additional spaces from a string.
     */
    public static function squish(string $string): string
    {
        return (new Stringable($string))
            ->replaceMatches('/[[:space:]]+/', ' ')
            ->trim();
    }
}
