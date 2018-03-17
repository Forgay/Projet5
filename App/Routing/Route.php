<?php


namespace Core\Routing;


class Route
{
    private $path;
    private $action;
    private $params;

    public function __construct(string $path, string $action, array $params = null)
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
}