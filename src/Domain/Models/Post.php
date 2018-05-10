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
     * @var
     */
    private $image;

    /**
     * @var
     */
    private $date;

    /**
     * @var
     */
    private $dateModify;

    /**
     * @var int
     */
    private $posted;

    /**
     * Post constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $content
     * @param int $posted
     */
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