<?php

namespace App\Routing;


use Symfony\Component\HttpFoundation\Request;

class ActionResolver
{
    /**Instancie le controller lié à la route demandée
     * @param  $className
     * @param null $params
     * @return mixed
     */
    public function create($className, Request $request)
    {
       return new $className($request);
    }
}

