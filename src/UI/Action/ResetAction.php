<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class ResetAction
{
    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('ResetPassword.html.twig')
        );
        return $response->send();
    }

}