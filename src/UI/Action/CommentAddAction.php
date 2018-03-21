<?php


namespace Src\UI\Action;

use Src\Domain\Managers\CommentManager;


class CommentAddAction
{
    public function __invoke()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {

            if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['comment'])) {

                $nom = htmlspecialchars($_POST['nom']);
                $email = htmlspecialchars($_POST['email']);
                $comment = htmlspecialchars($_POST['comment']);
                $postId = htmlspecialchars($_GET['id']);

                return $this->getTwig()->render('postView.html.twig',
                    ['comments'=>CommentManager::addComment($nom, $email, $comment, $postId)]);
            } else {
                echo 'Attention : Tous les champs ne sont pas remplis !';
            }
        }
    }
}


