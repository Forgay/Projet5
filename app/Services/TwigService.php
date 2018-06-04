<?php


namespace App\Services;

use App\Kernel;

abstract class TwigService
{
    static private $twig;

    static public function getTwig()
    {
        if (TwigService::$twig === null) {
            $app = new Kernel();
            $loader = new \Twig_Loader_Filesystem('./../src/View');
            TwigService::$twig = new \Twig_Environment($loader, [
                'cache' => false,
                'debug' => true,
            ]);
            TwigService::$twig->addGlobal('message',$app->getSession());
            TwigService::$twig->addExtension(new \Twig_Extension_Debug());

            }
        return TwigService::$twig;
    }
}
