<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class ConnectAction
{
    public function __invoke()
    {
        return new Response(
            TwigService::getTwig()->render('connectView.html.twig'));
    }
}