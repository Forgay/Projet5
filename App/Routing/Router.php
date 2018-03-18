<?php


namespace Core\Routing;

use Core\Routing\Route;

class Router
{
    private $routes = [];
    private $actionResolver;

    public function __construct()
    {
        $this->actionResolver = new ActionResolver();
    }

    public function loadRoutes()
    {
        $route = require __DIR__ . './../../Config/routes.php';

        foreach ($route as $route) {
            $this->routes[] = new Route ($route['path'], $route['action'], $route['params']);
        }
    }

    public function catchParams(string $request, array $params)
    {
        $params = preg_match($params, $request, $results);
        if ($results) {
            $route->getParams($params);
        } else {
            $route->setPath($path);
        }
    }

    public function handleResquest(string $request)
    {
        foreach ($this->routes as $route) {
            $this->catchParams($request, $route->getParams());
            if ($route->getPath() === $request) {
                $action = $this->actionResolver->create($route->getAction());
                return $action;
            }
        }

        $action = $this->actionResolver->create(NotFoundAction::class);
        return $action();
    }
}
