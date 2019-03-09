# TypeGuard - PHP type validation partly inspired by [Ceylon Union and Intersection types](https://ceylon-lang.org/documentation/1.3/tour/types/)

[![Build Status](https://travis-ci.com/ThoroughPHP/TypeGuard.svg?branch=master)](https://travis-ci.com/ThoroughPHP/TypeGuard)
[![Coverage Status](https://coveralls.io/repos/github/ThoroughPHP/TypeGuard/badge.svg)](https://coveralls.io/github/ThoroughPHP/TypeGuard)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Features

TypeGuard can validate:

- Scalar types: `string`, `integer`, etc.:

```php
(new TypeGuard('string'))->match('foo'); // => true
```

- Object types: `ArrayAccess`, `stdClass`, etc.:

```php
(new TypeGuard('stdClass'))->match(new stdClass()); // => true
```

- Union types: `string|integer`:

```php
$guard = new TypeGuard('string|integer');
$guard->match('foo'); // => true
$guard->match(1); // => true
```

- Intersection types: `ArrayAccess&Countable`:

```php
(new TypeGuard('ArrayAccess&Countable'))->match(new ArrayIterator()); // => true
```

- Optional types: `?string`:

```php
(new TypeGuard('?string'))->match(null); // => true
```

