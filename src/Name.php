<?php

namespace Watson\Nameable;

use Illuminate\Support\Arr;
use Illuminate\Support\Stringable;
use JsonSerializable;
use Watson\Nameable\Str;

class Name implements JsonSerializable
{
    /**
     * The raw first name.
     */
    protected $firstName;

    /**
     * The raw last name attribute.
     */
    protected $lastName;

    /**
     * Create a new name instance.
     */
    public function __construct(string $firstName, ?string $lastName = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * Create a new name instance from a single string.
     */
    public static function from(?string $name): self
    {
        $components = explode(' ', trim($name), 2);

        $lastName = Arr::get($components, 1)
            ? Str::squish(Arr::get($components, 1))
            : null;

        return new static(Arr::get($components, 0), $lastName);
    }

    /**
     * Get the first name.
     */
    public function first(): string
    {
        return $this->firstName;
    }

    /**
     * Get the last name.
     */
    public function last(): ?string
    {
        return $this->lastName;
    }

    /**
     * Get the full name.
     */
    public function full(): string
    {
        return collect([$this->firstName, $this->lastName])
            ->filter()
            ->join(' ');
    }

    /**
     * Get the first name with the initial of the last name, if the last name is available.
     */
    public function familiar(): string
    {
        if ($this->lastName) {
            return sprintf("%s %s.", $this->firstName, Str::firstLetter($this->lastName));
        }

        return $this->firstName;
    }

    /**
     * Get the initial of the first name with the last name, if the last name is available.
     */
    public function abbreviated(): string
    {
        if ($this->lastName) {
            return sprintf("%s. %s", Str::firstLetter($this->firstName), $this->lastName);
        }

        return $this->firstName;
    }

    /**
     * Get the last name and first name separated by a comma, if the last name is available.
     */
    public function sorted(): string
    {
        if ($this->lastName) {
            return sprintf("%s, %s", $this->lastName, $this->firstName);
        }

        return $this->firstName;
    }

    /**
     * Get the initials of the name, removing any words in parenthesis or brackets, or special characters.
     */
    public function initials(): string
    {
        return (new Stringable($this->full))
            ->replaceMatches('/(\(|\[).*(\)|\])/', '')
            ->matchAll('/([[:word:]])[[:word:]]*/i')
            ->join('');
    }

    /**
     * Forward attributes to methods.
     */
    public function __get($key): ?string
    {
        if ($this->wantsPossessive($key)) {
            $key = Str::replaceLast('possessive', '', $key);

            return $this->possessive($this->{$key});
        }

        if (method_exists($this, Str::studly($key))) {
            return $this->{Str::studly($key)}();
        }

        return null;
    }

    /**
     * Get the string representation of the name.
     */
    public function __toString(): string
    {
        return $this->full();
    }

    /**
     * Get the JSON representation of the name.
     */
    public function jsonSerialize(): string
    {
        return $this->full();
    }

    /**
     * Determine if the user wants a possessive variant.
     */
    protected function wantsPossessive($key): bool
    {
        return Str::endsWith($key, 'possessive');
    }

    /**
     * Get the possessive variant of the string.
     */
    protected function possessive(string $string): string
    {
        return sprintf("%s'%s", $string, (Str::endsWith($string, 's') ? null : 's'));
    }
}
