<?php


namespace gthareau\Entity;


class Comment
{

    protected $id;
    protected $nom;
    protected $email;
    protected $comment;
    protected $post_id;
    protected $date_comment;
    protected $seen;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function getDateComment()
    {
        return $this->date_comment;
    }

    public function getSeen()
    {
        return $this->seen;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setPostid($postid)
    {
        $this->post_id = $postid;
    }

    public function setDateComment($date_comment)
    {
        $this->date_comment = $date_comment;
    }

    public function setSeen($seen)
    {
        $this->seen = $seen;
    }
}