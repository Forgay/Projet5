<?php

namespace App\Routing;


class ActionResolver
{
    public function create(string $className,$params=[])
    {
        return new $className($params);
    }
}