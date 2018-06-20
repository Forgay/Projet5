<?php


namespace App;


use App\Routing\Router;
use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
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
        TwigService::getTwig()->addGlobal('message',$request->getSession());
        return new Router($request);
    }
    public function getSession()
    {

        return $this->session;

    }
}