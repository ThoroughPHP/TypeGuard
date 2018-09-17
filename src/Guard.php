<?php

namespace TypeGuard;

final class Guard
{
    /** @var TypeInterface */
    private $type;

    public function __construct(string $typeName)
    {
        if ($optional = $this->isOptional($typeName)) {
            $typeName = substr($typeName, 1);
        }

        if ($array = $this->isArray($typeName)) {
            $typeName = substr($typeName, 0, -2);
        }

        if ($this->isUnion($typeName)) {
            $type = new UnionType(array_filter(explode(UnionType::SEPARATOR, $typeName), 'trim'));
        } elseif ($this->isIntersection($typeName)) {
            $type = new IntersectionType(array_filter(explode(IntersectionType::SEPARATOR, $typeName), 'trim'));
        } else {
            $type = new Type($typeName);
        }

        $type = $array ? new ArrayType($type) : $type;

        $this->type = $optional ? new OptionalType($type) : $type;
    }

    private function isOptional(string $typeName): bool
    {
        return strpos($typeName, '?') === 0;
    }

    private function isArray(string $typeName): bool
    {
        return (bool) preg_match('/(?:\[\])$/', $typeName);
    }

    private function isUnion(string $typeName): bool
    {
        return strpos($typeName, UnionType::SEPARATOR) !== false;
    }

    private function isIntersection(string $typeName): bool
    {
        return strpos($typeName, IntersectionType::SEPARATOR) !== false;
    }

    public function match($parameter): bool
    {
        return $this->type->match($parameter);
    }
}