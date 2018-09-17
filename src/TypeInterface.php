<?php

namespace TypeGuard;

interface TypeInterface
{
    /**
     * @param mixed $parameter
     * @return bool
     */
    public function match($parameter): bool;
}