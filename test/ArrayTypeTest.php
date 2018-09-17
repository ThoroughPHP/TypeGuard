<?php

namespace TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use TypeGuard\ArrayType;
use TypeGuard\IntersectionType;
use TypeGuard\Type;
use TypeGuard\TypeInterface;
use TypeGuard\UnionType;

final class ArrayTypeTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(TypeInterface $type, $parameter, bool $result): void
    {
        $this->assertEquals($result, (new ArrayType($type))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            [new Type('string'), ['foo', 'bar'], true],
            [new Type('string'), ['foo', 1], false],
            [
                new UnionType(['ArrayAccess', 'Countable']),
                [new \ArrayIterator, new \ArrayIterator],
                true
            ],
            [
                new UnionType(['ArrayAccess', 'Countable']),
                [new \ArrayObject, new \ArrayIterator],
                true
            ],
            [
                new UnionType(['ArrayAccess', 'Countable']),
                [new \stdClass, new \ArrayIterator],
                false
            ],
            [
                new UnionType(['stdClass', 'Countable']),
                [new \ArrayObject, new \ArrayIterator],
                true
            ],
            [
                new UnionType(['stdClass', 'Countable']),
                [new \ArrayObject, new \stdClass],
                true
            ],
            [
                new IntersectionType(['ArrayAccess', 'Countable']),
                [new \ArrayObject, new \ArrayIterator],
                true
            ],
            [
                new IntersectionType(['ArrayAccess', 'Countable']),
                [new \ArrayObject, new \stdClass],
                false
            ],
        ];
    }
}