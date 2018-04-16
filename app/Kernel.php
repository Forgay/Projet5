<?php


namespace App;


use App\Routing\Router;
use Symfony\Component\HttpFoundation\Request;


class Kernel
{
    public function boot(Request $request)
    {
        return new Router($request);
    }
}