<?php


namespace Src\Domain\Managers;

use App\Bdd\Manager;


class CommentManager extends Manager
{

    public function getComments()
    {
        $req = $this->getConnexion()->query("
        SELECT  comments.id,
                comments.nom,
                comments.email,
                comments.date_comment,
                comments.post_id,
                comments.comment,
                posts.title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        WHERE comments.seen = '1'
        ORDER BY comments.date_comment ASC
    ");

        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }

    public function getCommentById($id)
    {

        $req = $this->getConnexion()->prepare("SELECT * FROM comments WHERE post_id={$_GET['id']} AND seen=1  ORDER BY date_comment DESC");
        $req->execute(array($id));
        $result = $req;
        return $result;

    }

    public function addComment($nom, $email, $comment, $post_id)
    {
        $req = $this->getConnexion()->prepare("INSERT INTO comments(nom,email,comment,post_id,date_comment) VALUES (?, ?, ?, ?, NOW())");
        $affectComment = $req->execute(array($nom, $email, $comment, $post_id));
        return $affectComment;
    }

    public function countComment()
    {
        $query = $this->getConnexion()->query("SELECT COUNT(id) FROM comments");
        return $nombre = $query->fetch();
    }

    public function validComment($id)
    {
        $req = $this->getConnexion()->prepare("UPDATE comments SET  seen='1' WHERE id=?");
        $valid = $req->execute(array($id));
        return $valid;
    }
    public function delComment($id)
    {
        $req = $this->getConnexion()->prepare("DELETE FROM comments WHERE id=? ");
        $req->execute(array($id));

    }
}