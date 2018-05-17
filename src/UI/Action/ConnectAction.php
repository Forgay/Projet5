<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConnectAction
{
    /**
     * ConnectAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Sending to the connection page
     *
     * @return Response
     */
    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('ConnectView.html.twig'));
        return $response->send();
    }
}
