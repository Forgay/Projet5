<?php

namespace App\Routing;


class ActionResolver
{
    /**Instancie le controller lié à la route demandée
     * @param string $className
     * @param null $params
     * @return mixed
     */
    public function create(string $className, $params=null)
    {
       return new $className($params);
    }
}

