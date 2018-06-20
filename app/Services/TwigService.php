<?php


namespace App\Services;

abstract class TwigService
{
    static private $twig;

    static public function getTwig()
    {
        if (TwigService::$twig === null) {

            $loader = new \Twig_Loader_Filesystem('./../src/View');
            TwigService::$twig = new \Twig_Environment($loader, [
                'cache' => false,
                'debug' => true,
            ]);


            TwigService::$twig->addExtension(new \Twig_Extension_Debug());

            }
        return TwigService::$twig;
    }
}
