<?php


namespace Core;



class Kernel
{
    public function boot(string $request)
    {
        return new Router($request);
    }
}