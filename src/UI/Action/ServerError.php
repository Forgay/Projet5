<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 05/06/2018
 * Time: 10:15
 */

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class ServerError
{
    /**
     * @return $this response
     */
    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('500.html.twig')
        );
        return $response->send();
    }
}
