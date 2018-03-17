<?php

namespace Core\Routing;


class ActionResolver
{
    public function create(string $className)
    {
        return new $className();
    }
}