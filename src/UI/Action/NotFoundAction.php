<?php


namespace src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class NotFoundAction
{

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('404.html.twig')
        );
        return $response->send();
    }
}
