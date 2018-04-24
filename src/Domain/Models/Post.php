<?php


namespace Src\Domain\Models;

class Post
{

    private $id;
    private $title;
    private $content;
    private $writer;
    private $image;
    private $date;
    private $dateModify;
    private $posted;

    public function __construct(
        string $id,
        string $title,
        string $content,
        int $posted
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->posted = $posted;

    }
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getWriter()
    {
        return $this->writer;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDateModify()
    {
        return $this->dateModify;
    }

    public function getPosted()
    {
        return $this->posted;
    }

}