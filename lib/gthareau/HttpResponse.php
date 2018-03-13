<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 12/03/2018
 * Time: 19:01
 */

namespace gthareau;


class HttpResponse extends ApplicationComponent
{
    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: '.$location);
        exit;
    }

    public function redirect404()
    {

    }

    public function send()
    {

        exit($this->page->getGeneratedPage());
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }

}