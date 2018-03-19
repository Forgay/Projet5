<?php


namespace App;


use App\Routing\Router;

class Kernel
{
    public function boot(string $request)
    {
        return new Router($request);
    }
}