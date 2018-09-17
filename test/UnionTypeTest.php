<?php

namespace TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use TypeGuard\UnionType;

final class UnionTypeTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(array $typeNames, $parameter, bool $result): void
    {
        $this->assertEquals($result, (new UnionType($typeNames))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            [['ArrayAccess', 'Countable'], new \ArrayIterator, true],
            [['Countable', 'RecursiveIterator'], new \ArrayIterator, true],
        ];
    }
}