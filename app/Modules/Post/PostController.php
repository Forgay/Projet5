<?php


namespace a\Modules\Post;

use Gthareau\Controller;
use Gthareau\HttpRequest;
use Entity\Post;
use Gthareau\Session;

class PostController extends Controller
{
    public function executeListPostsFront()
    {
    $listPosts = $this->manager->getManagerOf('Post')->getPosts();
    $this->page->addVar('listPosts',$listPosts);
    }


}