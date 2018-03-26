<?php


namespace src\UI\Action;

use App\Services\TwigService;

class NotFoundAction
{

    public function __invoke()
    {
        return TwigService::getTwig()->render('404.html.twig');
    }

}