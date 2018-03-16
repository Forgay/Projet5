<?php


namespace Entity;


class Post
{

    protected $id;
    protected $title;
    protected $content;
    protected $writer;
    protected $image;
    protected $date;
    protected $datemodify;
    protected $posted;


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

    public function getDatemodify()
    {
        return $this->datemodify;
    }

    public function getPosted()
    {
        return $this->posted;
    }

}