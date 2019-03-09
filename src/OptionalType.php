<?php

namespace ThoroughPHP\TypeGuard;

final class OptionalType implements TypeInterface
{
    /** @var TypeInterface */
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

        if ($type === 'NULL') {
            return true;
        }

        return $this->type->match($parameter);
    }
}