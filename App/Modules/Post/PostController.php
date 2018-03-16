<?php


namespace App\Modules\Post;

use Gthareau\Controller;
use Gthareau\HttpRequest;
use Gthareau\Entity\Post;


class PostController extends Controller
{
    public function executeListPostsFront()
    {
    $listPosts = $this->manager->getManagerOf('Post')->getPosts();
    $this->page->addVar('listPosts',$listPosts);
    }


}