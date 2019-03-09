<?php

namespace ThoroughPHP\TypeGuard;

final class UnionType implements TypeInterface
{
    public const SEPARATOR = '|';

    /** @var TypeInterface[] */
    private $types;

    public function __construct(array $typeNames)
    {
        $this->types = array_map(function ($typeName) {
            return new Type($typeName);
        }, $typeNames);
    }

    /**
     * @param mixed $parameters
     * @return bool
     */
    public function match($parameters): bool
    {
        return array_reduce($this->types, function (bool $carry, TypeInterface $type) use ($parameters): bool {
            return $carry || $type->match($parameters);
        }, false);
    }
}