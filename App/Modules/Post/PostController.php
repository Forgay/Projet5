<?php


namespace App\Modules\Post;

use gthareau\Controller;
use gthareau\HttpRequest;
use gthareau\Entity\Post;


class PostController extends Controller
{
    public function listPosts()
    {
    $listPosts = $this->manager->getManagerOf('Post')->getPosts();
    $this->page->addVar('listPosts',$listPosts);
    }


}