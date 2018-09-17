# TypeGuard - PHP type validation partly inspired by [Ceylon Union and Intersection types](https://ceylon-lang.org/documentation/1.3/tour/types/)

[![Build Status](https://travis-ci.com/Sevavietl/TypeGuard.svg?branch=master)](https://travis-ci.com/Sevavietl/TypeGuard)
[![Coverage Status](https://coveralls.io/repos/github/Sevavietl/TypeGuard/badge.svg)](https://coveralls.io/github/Sevavietl/TypeGuard)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Features

TypeGuard can validate:

- Scalar types: `string`, `integer`, etc.:

```php
(new \TypeGuard\Guard('string'))->match('foo'); // => true
```

- Object types: `ArrayAccess`, `stdClass`, etc.:

```php
(new \TypeGuard\Guard('stdClass'))->match(new stdClass()); // => true
```

- Union types: `string|integer`:

```php
$guard = new \TypeGuard\Guard('string|integer');
$guard->match('foo'); // => true
$guard->match(1); // => true
```

- Intersection types: `ArrayAccess&Countable`:

```php
(new \TypeGuard\Guard('ArrayAccess&Countable'))->match(new ArrayIterator()); // => true
```

- Optional types: `?string`:

```php
(new \TypeGuard\Guard('?string'))->match(null); // => true
```

