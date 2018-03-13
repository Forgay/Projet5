<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 12/03/2018
 * Time: 19:09
 */

namespace gthareau;


abstract class ApplicationComponent
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}