<?php

namespace Src\UI\Action;

use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Services\CommentBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

class CommentAddAction
{
    private $commentManager;
    private $request;
    private $commentBuilder;
    private $session;

    public function __construct(Request $request)
    {

        $this->request = $request;
        $this->commentManager = new CommentManager();
        $this->commentBuilder = new CommentBuilder();
        $this->session = new Session();
    }

    public function __invoke()
    {

        if (!empty($this->request->get('nom')) && !empty($this->request->get('email')) && !empty($this->request->get('content'))) {
            $this->commentBuilder->build(
                $this->request->get('nom'),
                $this->request->get('email'),
                $this->request->get('content'),
                $this->request->attributes->get(0)
            );

            $this->commentManager->addComment($this->commentBuilder->getComment());
            $response = new RedirectResponse('/post/detail/'.$this->request->attributes->get(0));
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('Empty','Attention : Tous les champs ne sont pas remplis !');
        }

    }
}

