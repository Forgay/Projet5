<?php


namespace App;


use App\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Session\Session;


class Kernel
{
    /**
     * @var Session
     *
     */
    private $session;


    public function boot(Request $request)
    {
        $this->session = $request->getSession();

        return new Router($request);
    }
    public function getSession()
    {
        return $this->session;
    }
}