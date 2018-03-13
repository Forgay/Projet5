<?php


namespace gthareau;


class Manager
{

    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}