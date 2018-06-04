<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


Final class UploadImages
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->session = new Session;
    }

    public function __invoke()
    {
        foreach ($this->request->files as $file) {
            if ($file->isValid() AND $file->getError() == 0) {
                if ($file->getClientSize() <= 1000000) {
                    $extension_upload = $file->getMimeType();
                    $extension_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extension_autorisees)) {
                        $file->move('Web/img/upload', $file->getBaseName());
                        $this->session->getFlashBag()->add('send', 'l\'image est enregistrée');
                    }
                }
            }
        }
    }
}
