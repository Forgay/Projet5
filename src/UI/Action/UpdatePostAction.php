<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 09/04/2018
 * Time: 14:13
 */

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdatePostAction
{
    private $postManager;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
    }

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('UpdatePostView.html.twig', [
                'post' => $this->postManager->updatePost(
                    $this->request->get('title'),
                    $this->request->get('content'),
                    $this->request->get('posted'),
                    $this->request->attributes->all()
                )
            ])
        );
        return $response->send();
    }
}
