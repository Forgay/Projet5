<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Src\Domain\Managers\PostManager;
use App\Services\PostBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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
    }

    public function __invoke()
    {
        if (!empty($this->request->get('nom')) && !empty($this->request->get('email')) && !empty($this->request->get('content'))) {
            $this->postBuilder->build(
                $this->request->get('title'),
                $this->request->get('content'),
                $this->request->get('posted'),
                $this->request->get('writer'),
                $this->request->get('dateModify'),
                $this->request->get('posted')
            );
            $this->postManager->addPost($this->postBuilder->getPost());
            $response = new RedirectResponse('/post/add');
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
            $response = new RedirectResponse('/post/add',[
                'message' => $this->session->getFlashBag()->get('Empty')
            ]);
            return $response->send();
        }
    }
}