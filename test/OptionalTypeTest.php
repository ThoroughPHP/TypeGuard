<?php

namespace ThoroughPHP\TypeGuard\Test;

use PHPUnit\Framework\TestCase;
use ThoroughPHP\TypeGuard\OptionalType;
use ThoroughPHP\TypeGuard\Type;

final class OptionalTypeTest extends TestCase
{
    /**
     * @dataProvider matchDataProvider
     */
    public function testMatch(string $typeName, $parameter, bool $result): void
    {
        $this->assertEquals($result, (new OptionalType(new Type($typeName)))->match($parameter));
    }

    public function matchDataProvider(): array
    {
        return [
            ['string', null, true],
            ['integer',  null, true],
        ];
    }
}