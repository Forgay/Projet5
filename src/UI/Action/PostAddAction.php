<?php

namespace Src\UI\Action;

use App\Services\UploadImages;
use App\Services\ValidatorService;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Src\Domain\Managers\PostManager;
use App\Services\PostBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostAddAction
{
    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var PostBuilder
     */
    private $postBuilder;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var ValidatorService
     */
    private $validator;
    /**
     * @var
     */

    private $uploadimages;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * PostAddAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
        $this->postBuilder = new PostBuilder();
        $this->session = new Session();
        $this->validator = new ValidatorService();
    }

    public function __invoke()
    {


        $this->uploadimages = new UploadImages($this->request);
        $this->uploadimages->upload();


            $this->postBuilder->buildAddPost(
                $this->request->get('title'),
                $this->request->get('content'),
                $this->request->get('posted',"off"),
                $this->request->get('writer','admin'),
                $this->request->files->get('images')->getClientOriginalName()
            );

            $this->postManager->addPost($this->postBuilder->getPost());
            $response = new RedirectResponse('/post/add');
            return $response->send();

            $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
            $response = new Response('/post/add',[
                'flash' => $this->session->getFlashBag()->get('Empty')
            ]);
            return $response->send();

    }
}
