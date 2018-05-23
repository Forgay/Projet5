<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use

final class UploadImages
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
        if (isset($_FILES['images']) AND $_FILES['images']['error'] == 0)
        {
            if ($_FILES['images']['size']<= 1000000)
            {
                $infosfichier= pathinfo($_FILES['images']['name']);
                $extension_upload = $infosfichier['extension'];
                $extension_autorisees = array('jpg','jpeg','gif','png');
                if (in_array($extension_upload,$extension_autorisees))
                {
                    move_uploaded_file(
                        $_FILES['images']['tmp_name'],
                        'Web/img/upload'.basename($_FILES['images']['name'])
                    );
                    $this->session->getFlashBag()->add('send','l\'image est enregistrée');
                }
            }
        }
    }
}
