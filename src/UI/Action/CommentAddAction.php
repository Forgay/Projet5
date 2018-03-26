<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CommentAddAction
{
    private $commentManager;

    public function __construct()
    {
        $request = Request::createFromGlobals();
        $id =$request->query->get('id');
        $this->commentManager = new CommentManager();
    }

    public function __invoke()
    {
        if (isset($id) && $id>0) {

            if (!empty($request['nom']) && !empty($request['email']) && !empty($request['comment'])) {

                $nom = htmlspecialchars($request['nom']);
                $email = htmlspecialchars($request['email']);
                $comment = htmlspecialchars($request['comment']);
                $postId = htmlspecialchars($request->query->get('id'));

                return new Response(
                    TwigService::getTwig()->render('postView.html.twig',
                    ['comments'=>$this->commentManager->addComment($nom, $email, $comment, $postId)]));
            } else {
                echo 'Attention : Tous les champs ne sont pas remplis !';
            }
        }
    }
}


