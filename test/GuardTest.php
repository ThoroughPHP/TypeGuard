<?php

namespace TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use TypeGuard\Guard;

final class GuardTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(string $stringRepresentation, $parameter): void
    {
        $this->assertTrue((new Guard($stringRepresentation))->match($parameter));
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