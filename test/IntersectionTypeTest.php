<?php

namespace ThoroughPHP\TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use ThoroughPHP\TypeGuard\IntersectionType;

final class IntersectionTypeTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(array $typeNames, $parameter, bool $result): void
    {
        $this->assertEquals($result, (new IntersectionType($typeNames))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            [['ArrayAccess', 'Countable'], new \ArrayIterator, true],
            [['Countable', 'RecursiveIterator'], new \ArrayIterator, false],
        ];
    }
}