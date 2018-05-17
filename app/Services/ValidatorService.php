<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ValidatorService
{
    private $data;
    private $session;
    private $content;


    public function isValid($data, $content)
    {
        $this->data = $data;
        $this->content = $content;
        $this->session = new Session();

        foreach ($data as $valid) {

            if (empty($valid)) {
                $this->session->getFlashBag()->add('vide', 'Attention : un champ n\'est pas rempli !');
                $response = new Response(
                    TwigService::getTwig()->render(
                        $this->content, [
                            'error' => $this->session->getFlashBag()->get('vide')
                    ]));
                return $response->send();
            }
        }
    }
}
