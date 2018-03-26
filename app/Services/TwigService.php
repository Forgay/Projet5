<?php


namespace App\Services;

//use Twig_Environment;
//use Twig_Loader_Filesystem;
//use Twig_Extension_Debug;

abstract class TwigService
{
    static private $twig;


    static public function getTwig()
    {
        if (TwigService::$twig === null)
        {
            $loader = new \Twig_Loader_Filesystem('./../src/View');
            TwigService::$twig = new \Twig_Environment($loader, [
                'cache' => false //'../var/twig',
            ]);

            TwigService::$twig->addExtension(new \Twig_Extension_Debug());

        }
        return TwigService::$twig;
    }
}

