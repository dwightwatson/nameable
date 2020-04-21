# nameable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/watson/nameable.svg?style=flat-square)](https://packagist.org/packages/watson/nameable)
[![Build Status](https://img.shields.io/travis/watson/nameable/master.svg?style=flat-square)](https://travis-ci.org/watson/nameable)
[![Total Downloads](https://img.shields.io/packagist/dt/watson/nameable.svg?style=flat-square)](https://packagist.org/packages/watson/nameable)

This package provides a caster and a formatter class for presenting your user's names. It can get a user's first, last or full name, their initials, and common abbreviations. Instead of separating the fields over a few database columns you can store a user's name in a single column and fetch what you need.

This package is based upon Basecamp's [`name_of_person`](https://github.com/basecamp/name_of_person) package for Ruby/Rails.

## Installation

You can install the package via Composer:

```bash
composer require watson/nameable
```

Then use the `Nameable` cast for any Eloquent models you want to use as a name.

```php
use Watson\Nameable\Nameable;

class User extends Model
{
    protected $casts = [
        'name' => Nameable::class,
    ];
}
```

Alternatively, you can interact with the `Name` class directly.

```php
use Watson\Nameable\Name;

$name = new Name('Dwight', 'Conrad Watson');

$name = Name::from('Dwight Conrad Watson');
```

## Usage

```php
$user = new User(['name' => 'Dwight Conrad watson']);

$user->name->full        // Dwight Conrad Watson
$user->name->first       // Dwight
$user->name->last        // Watson
$user->name->familiar    // Dwight W. 
$user->name->abbreviated // D. Watson
$user->name->sorted      // Watson, Dwight
$user->name->initials    // DCW
```

In addition there are possessive variants you can use which will work correctly with names that end in `s`.

```php
$user->name->full_possessive  // Dwight Conrad Watson's
$user->name->first_possessive // Dwight's
$user->name->last_possessive  // Watson's
$user->name->sorted_possessive  // Watson, Dwight's
$user->name->initials_possessive  // DCW's
$user->name->abbreviated_possessive  // D. Watson's
```

If a user doesn't provide a full name (for example, just a first name) the attributes will just omit the last name.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
