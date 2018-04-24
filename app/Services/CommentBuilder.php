<?php

namespace App\Services;

use Src\Domain\Models\Comment;

class CommentBuilder
{
    private $comment;

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