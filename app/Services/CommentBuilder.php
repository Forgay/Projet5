<?php

namespace App\Services;

use Src\Domain\Models\Comment;

class CommentBuilder
{
    /**
     * @var
     */
    private $comment;

    /**
     * @param string $nom
     * @param string $email
     * @param string $content
     * @param int $postId
     */
    public function build(string $nom,
                          string $email,
                          string $content,
                          int $postId
    )
    {
        $this->comment = new Comment($nom, $email, $content, $postId);
    }

    public function getComment()
    {
        return $this->comment;
    }
}