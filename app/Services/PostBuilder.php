<?php

namespace App\Services;

use Src\Domain\Models\Post;

class PostBuilder
{
    private $post;

    public function build(
        string $id,
        string $title,
        string $content,
        string $writer

    )
    {
        $this->post = new Post($id, $title, $content,$writer);
    }

    public function buildAddPost(
        string $title,
        string $content,
        string $image,
        string $posted,
        string $writer

    )
    {
        $this->post = new Post($title, $content, $image, $posted, $writer);
    }

    public function getPost()
    {
        return $this->post;
    }
}
