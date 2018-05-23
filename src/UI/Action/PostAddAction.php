<?php

namespace Src\UI\Action;

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
           foreach ( $this->request->files as $file )
           {
               dump($file->getFilename());
           }
        if ($violations = $this->validator->validator($this->request->request->all(), ['is_string', 'email', 'empty'])) {
            $this->postBuilder->build(
                $this->request->get('title'),
                $this->request->get('content'),
                $this->request->get('posted'),
                $this->request->get('writer'),
                $this->request->get('dateModify')
            );
            $this->postManager->addPost($this->postBuilder->getPost());
            $response = new RedirectResponse('/post/add');
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
            $response = new Response('/post/add',[
                'message' => $this->session->getFlashBag()->get('Empty')
            ]);
            return $response->send();
        }
    }
}
