<?php


namespace App\Services;


abstract class TwigService
{
    static private $twig;

    static public function getTwig()
    {
        if (TwigService::$twig === null)
        {
            $loader = new Twig_Loader_Filesystem('./View');
            TwigService::$twig = new Twig_Environment($loader, [
                'cache' => false //'../var/twig',
            ]);

        }
    }

}