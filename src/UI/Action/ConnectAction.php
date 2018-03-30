<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class ConnectAction
{
    public function __invoke()
    {
        $response =  new Response(
            TwigService::getTwig()->render('ConnectView.html.twig'));
        return $response->send();
    }

}