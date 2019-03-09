<?php

namespace ThoroughPHP\TypeGuard;

final class Type implements TypeInterface
{
    /** @var string */
    private $typeName;

    public function __construct(string $typeName)
    {
        $this->typeName = $typeName;
    }

    /**
     * @param mixed $parameter
     * @return bool
     */
    public function match($parameter): bool
    {
        if ('mixed' === $this->typeName) {
            return true;
        }

        $type = \gettype($parameter);

        return $type === 'object'
            ? $parameter instanceof $this->typeName
            : $type === $this->typeName;
    }
}