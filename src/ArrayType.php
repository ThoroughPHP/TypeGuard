<?php

namespace TypeGuard;

final class ArrayType implements TypeInterface
{
    /** @var TypeInterface  */
    private $type;

    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $parameter
     * @return bool
     */
    public function match($parameter): bool
    {
        $type = \gettype($parameter);

        if ($type !== 'array') {
            return false;
        }

        foreach ($parameter as $item) {
            if (! $this->type->match($item)) {
                return false;
            }
        }

        return true;
    }
}