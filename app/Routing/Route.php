<?php


namespace App\Routing;



class Route
{
    private $path;
    private $action;
    private $params;

    public function __construct(string $path, string $action, array $params)
    {
        $this->path = $path;
        $this->action = $action;
        $this->params = $params;
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
