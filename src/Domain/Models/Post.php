<?php


namespace Src\Domain\Models;

class Post
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $writer;
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $dateModify;

    /**
     * @var string
     */
    private $posted;


    public function __construct(
        string $title,
        string $content,
        string $posted,
        string $writer=null,
        string $dateModify=null
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->posted = $posted;
        $this->writer = $writer;
        $this->dateModify =  $dateModify;

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