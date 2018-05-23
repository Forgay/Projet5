<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\PostBuilder;
use App\Services\ValidatorService;
use Symfony\Component\HttpFoundation\Session\Session;

class UpDatePostAction
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
     * @var ValidatorService
     */
    private $validator;

    /**
     * @var Session
     */
    private $session;

    /**
     * UpDatePostAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
        $this->postManager = new PostManager();
        $this->postBuilder = new PostBuilder();
        $this->validator = new ValidatorService();
    }

    public function __invoke()
    {
        if ($violations = $this->validator->validator($this->request->request->all(), ['is_string', 'email', 'empty'])){
            $this->session->getFlashBag()->add('violations', $violations['0']);
            return new RedirectResponse($this->request->getPathInfo());
        }
        $this->postBuilder->build(
            $this->request->attributes->get(0),
            $this->request->get('title'),
            $this->request->get('content'),
            $this->request->get('posted'));

        $response = new Response(
            TwigService::getTwig()->render('UpdatePostView.html.twig', [
                'post' => $this->postManager->updatePost(
                    $this->postBuilder->getPost()
                )
            ])
        );
        return $response->send();
    }
}
