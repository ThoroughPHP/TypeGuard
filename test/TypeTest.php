<?php

namespace TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use TypeGuard\Type;

final class TypeTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(string $typeName, $parameter, bool $result)
    {
        $this->assertEquals($result, (new Type($typeName))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            ['string', 'foo', true],
            ['string', 1, false],
            ['integer', 1, true],
            ['integer', '1', false],
            ['NULL', null, true],
            ['ArrayAccess', new \ArrayIterator, true],
            ['Countable', new \ArrayIterator, true],
            ['mixed', 'foo', true],
            ['mixed', 1, true],
            ['mixed', null, true],
            ['mixed', new \ArrayIterator, true],
        ];
    }
}