<?php

namespace App\Services;

use Src\Domain\Models\Post;

class PostBuilder
{
    private $post;

    public function build(string $title,
                          string $content,
                          string $posted,
                          string $writer,
                          string $dateModify
    )
    {
        $this->post = new Post($title,$content,$posted,$writer,$dateModify);
    }

    public function getPost()
    {
        return $this->post;
    }

}
