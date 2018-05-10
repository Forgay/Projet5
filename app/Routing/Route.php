<?php


namespace App\Routing;



class Route
{
    private $path;
    private $action;
    private $params;
    private $secured;

    public function __construct(string $path, string $action, array $params, bool $secured )
    {
        $this->path = $path;
        $this->action = $action;
        $this->params = $params;
        $this->secured = $secured;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getSecured()
    {
        return $this->secured;
    }

    public function setPath($path)
    {
        if (is_string($path))
        {
            $this->path = $path;
        }
    }

    public function setAction($action)
    {
       if (is_string($action))
       {
           $this->action = $action;
       }
    }

     public function setParams(array $params)
    {
        $this->params = $params;
    }
}
