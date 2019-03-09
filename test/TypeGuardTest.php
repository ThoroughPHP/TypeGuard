<?php

namespace ThoroughPHP\TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use ThoroughPHP\TypeGuard\TypeGuard;

final class TypeGuardTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(string $stringRepresentation, $parameter): void
    {
        $this->assertTrue((new TypeGuard($stringRepresentation))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            ['string', 'foo'],
            ['integer', 1],
            ['?integer', null],
            ['integer[]', [1, 2, 3]],
            ['boolean', false],
            ['string|integer', 'foo'],
        ];
    }
}