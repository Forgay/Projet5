<?php


namespace Src\Domain\Managers;

use App\Bdd\Manager;




class PostManager extends Manager
{

    public function getPosts()
    {
        $req = $this->getConnexion()->query('SELECT * FROM posts ORDER BY id DESC');
        $results = array();
        while ($rows = $req->fetchAll()) {
            $results[] = $rows;
        }
        return $results;
    }

    public function getPost($id)
    {
        $req = $this->getConnexion()->prepare("SELECT * FROM posts WHERE posted= 1 AND id = :id");
        $req->bindValue(':id', $id);
        $req->execute(array($id));
        $post = $req->fetch();
        return $post;
    }

    public function CountPost()
    {

        $query = $this->getConnexion()->query("SELECT COUNT(id) FROM posts");
        return $nombre = $query->fetch();
    }

    public function adPost($title, $content, $posted)
    {
        $p = [
            'title' => $title,
            'content' => $content,
            'posted' => $posted
        ];
        $req = $this->getConnexion()->prepare("INSERT INTO posts(title,content,writer,date,posted) VALUES (:title,:content,'admin',NOW(),:posted)");
        $req->execute($p);

    }

    public function updatePost($title, $content, $posted, $id)
    {
        $a = [
            'title' => $title,
            'content' => $content,
            'posted' => $posted,
            'id' => $id
        ];
        $req = $this->getConnexion()->prepare("UPDATE posts SET title=:title, content=:content, datemodify=NOW(), posted=:posted WHERE id=:id");
        $req->execute($a);
    }

    public function delPost($id)
    {
        $req = $this->getConnexion()->prepare("DELETE FROM posts WHERE id=? ");
        $req->execute(array($id));

    }
}