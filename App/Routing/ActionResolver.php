<?php

namespace App\Routing;


class ActionResolver
{
    public function create(string $className,$params=null)
    {
        return new $className($params);
    }
}