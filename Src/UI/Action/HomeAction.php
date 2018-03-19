<?php


namespace Src\Action;
use App\Services\TwigService;
use Src\Domain\Managers\PostManager;

class HomeAction
{
    public function __invoke()
    {

        return $this->getTwig()->render('listPost.html.twig',['posts'=>PostManager::getPosts()]);
    }

}