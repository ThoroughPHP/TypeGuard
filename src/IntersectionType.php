<?php

namespace TypeGuard;

final class IntersectionType implements TypeInterface
{
    public const SEPARATOR = '&';

    /** @var TypeInterface[] */
    private $types;

    public function __construct(array $typeNames)
    {
        $this->types = array_map(function ($typeName): TypeInterface {
            return new Type($typeName);
        }, $typeNames);
    }

    /**
     * @param mixed $parameter
     * @return bool
     */
    public function match($parameter): bool
    {
        return array_reduce($this->types, function (bool $carry, TypeInterface $type) use ($parameter): bool {
            return $carry && $type->match($parameter);
        }, true);
    }
}