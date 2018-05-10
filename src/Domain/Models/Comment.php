<?php


namespace Src\Domain\Models;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $postId;

    /**
     * @var
     */
    private $dateComment;

    /**
     * @var
     */
    private $seen;

    /**
     * Comment constructor.
     *
     * @param string $nom
     * @param string $email
     * @param string $content
     * @param int $postId
     */
    public function __construct(
        string $nom,
        string $email,
        string $content,
        int $postId
    ) {
        $this->nom = $nom;
        $this->email = $email;
        $this->content = $content;
        $this->postId = $postId;

    }

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

    public function getContent()
    {
        return $this->content;
    }

    public function getPostId()
    {
        return $this->postId;
    }


    public function getDateComment()
    {
        return $this->dateComment;
    }

    public function getSeen()
    {
        return $this->seen;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    public function setDateComment($dateComment)
    {
        $this->dateComment = $dateComment;
        return $this;
    }

    public function setSeen($seen)
    {
        $this->seen = $seen;
        return $this;
    }
}