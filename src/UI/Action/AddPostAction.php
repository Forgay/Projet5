<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 23/04/2018
 * Time: 22:12
 */

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class AddPostAction
{

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('WritePostView.html.twig')
        );
        return $response->send();
    }
}
