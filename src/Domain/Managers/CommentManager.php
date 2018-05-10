<?php


namespace Src\Domain\Managers;

use App\Bdd\Manager;
use Src\Domain\Models\Comment;


class CommentManager extends Manager
{
    public function getComments()
    {
        $req = $this->getConnexion()->query("SELECT  
                comments.id,
                comments.nom,
                comments.email,
                comments.dateComment,
                comments.postId,
                comments.content,
                posts.title
        FROM comments
        JOIN posts
        ON comments.postId = posts.id 
        WHERE seen = 0 
        ORDER BY dateComment ASC ");

        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }

    public function getCommentById($id)
    {

        $req = $this->getConnexion()
            ->prepare("SELECT * FROM comments WHERE postId=? AND seen=1  ORDER BY dateComment DESC");

        $req->execute($id);
        $result = $req;

        return $result;

    }


    public function addComment(Comment $comment)
    {

        $req = $this->getConnexion()->prepare("INSERT INTO comments (nom, email, content, postId, dateComment, seen) VALUES (:nom, :email, :content, :postId, NOW(),1)");

        $req->bindValue(':nom', $comment->getNom(), \PDO::PARAM_STR);
        $req->bindValue(':email', $comment->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':postId', $comment->getPostId(), \PDO::PARAM_INT);

        $req->execute();
    }


    public function validComment($id)
    {
        $req = $this->getConnexion()->prepare("UPDATE comments SET  seen=1 WHERE id=?");

        return $req->execute($id);
    }

    public function delComment($id)
    {
        $req = $this->getConnexion()->prepare("DELETE FROM comments WHERE id=? ");
        $req->execute($id);

    }
}
