<?php


namespace App\Action;
use App\Services\TwigService;

class HomeAction
{
    public function __invoke()
    {

        return $this->getTwig()->render('tavue.html.twig');
    }
}