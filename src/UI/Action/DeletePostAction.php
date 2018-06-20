<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 10/06/2018
 * Time: 20:27
 */

namespace Src\UI\Action;


use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DeletePostAction
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
     * DeletePostAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
    }

    /**
     * Delete Post and redirection to dashboard
     *
     * @return RedirectResponse
     */
    public function __invoke()
    {
        $this->postManager->delPost($this->request->attributes->get(0));
        $response = new RedirectResponse('/post/list');
        return $response->send();
    }
}