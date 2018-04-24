<?php

namespace App\Services;

use Src\Domain\Models\Post;

class PostBuilder
{
    private $post;

    public function build(string $id,
                          string $title,
                          string $content,
                          string $posted
    )
    {
        $this->post = new Post($id,$title,$content,$posted);
    }

    public function getPost()
    {
        return $this->post;
    }

}
