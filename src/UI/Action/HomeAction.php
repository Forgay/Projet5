<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;

class HomeAction
{
    public function __invoke()
    {

        return TwigService::getTwig()->render('listPostView.html.twig',['posts'=>PostManager::getPosts()]);
    }

}