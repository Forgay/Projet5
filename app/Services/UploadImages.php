<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UploadImages
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function upload()
    {

       if ($this->request->files->get('images')->isValid() AND $this->request->files->get('images')->getError() == 0) {

            if ($this->request->files->get('images')->getClientSize() <= 1000000) {

                $extension_upload = $this->request->files->get('images')->getMimeType();
                $extension_autorisees = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');

                if (in_array($extension_upload, $extension_autorisees)) {

                    $this->request->files->get('images')->move('img/posts', $this->request->files->get('images')->getClientOriginalName());

                }
            }
        }

    }
}
