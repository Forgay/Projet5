<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class LoginAction
{
    /**
     * Displays the register page
     *
     * @return Response
     */
    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('RegisterView.html.twig')
        );
        return $response->send();
    }
}
