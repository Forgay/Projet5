<?php


namespace App\Action;


class HomeAction
{
    public function __invoke()
    {
        require __DIR__ . './../../../Templates.php';
        return $this->getTwig()->render('tavue.html.twig');
    }
}