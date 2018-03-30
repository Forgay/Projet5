<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CommentAddAction
{
    private $commentManager;
    private $request;


    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->commentManager = new CommentManager();
    }

    public function __invoke()
    {
        if (isset($id) && $id>0) {

            if (!empty($this->request->get('nom')) && !empty($this->request->get('email')) && !empty($this->request->get('comment'))) {

                $nom = htmlspecialchars($this->request->get('nom'));
                $email = htmlspecialchars($this->request->get('email'));
                $comment = htmlspecialchars($this->request->get('comment'));
                $postId = htmlspecialchars($this->request->query->get('id'));

                $response = new Response(
                    TwigService::getTwig()->render('postView.html.twig',
                    ['comments'=>$this->commentManager->addComment($nom, $email, $comment, $postId)]
                    )
                );
                return $response->send();
            } else {
                echo 'Attention : Tous les champs ne sont pas remplis !';
            }
        }
    }
}


