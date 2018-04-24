<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class LoginAction
{

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('RegisterView.html.twig')
        );
        return $response->send();
    }
}
