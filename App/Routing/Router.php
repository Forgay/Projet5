<?php


namespace App\Routing;


class Router
{
    private $routes = [];
    private $actionResolver;
    private $request;


    public function __construct($request)
    {
        $this->actionResolver = new ActionResolver();
        $this->request = $request;

    }

    public function loadRoutes()
    {
        $route = require __DIR__ . './../../Config/routes.php';

        foreach ($routes as $route) {
            $this->routes[] = new Route ($route['path'], $route['action'], $route['params']);
        }
    }

    /**
     * @param string $request
     * @param array $params
     */
    public function catchParams(string $request, array $params)
    {
        foreach ($params as $param) {
            $params = preg_match($param, $request, $results);

            if ($results) {
                $route->setParams($params);

            }
        }
    }


    public function handleResquest(string $request)
    {
        foreach ($this->routes as $route) {
            $this->catchParams($request, $route->getParams());
            if ($route->getPath() === $request) {
                $action = $this->actionResolver->create($route->getAction());
                return $action;
            } elseif (isset ($params)) {
                $action = $this->actionResolver->create($route->getAction(), $route->getParams());
                return $action;
            }

            $action = $this->actionResolver->create(NotFoundAction::class);
            return $action;
        }
    }
}
