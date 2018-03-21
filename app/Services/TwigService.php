<?php


namespace App\Services;

use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class TwigService
{
    static private $twig;

    static public function getTwig()
    {
        if (TwigService::$twig === null)
        {
            $loader = new Twig_Loader_Filesystem('./.../src/View');
            TwigService::$twig = new Twig_Environment($loader, [
                'cache' => false //'../var/twig',
            ]);

        }
        return TwigService::$twig;
    }
    public function render($twigPath,$parameters)
    {
        $view= TwigService::getTwig()->render($twigPath,$parameters);
        return $view;
    }
}