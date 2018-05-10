<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;

class ShowResetPasswordAction
{

    public function __invoke()
    {
     $response= new Response(
         TwigService::getTwig()->render('UpDatePassword.htlm.twig'));
     return $response->send();
    }
}