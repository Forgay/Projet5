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
        $this->loadRoutes();
        $this->handleResquest($request);
    }

    public function loadRoutes()
    {
        $routes = require __DIR__ . './../../Config/routes.php';

        foreach ($routes as $route) {
            $this->routes[] = new Route ($route['path'], $route['action'], $route['params']);
        }

    }

    /**
     * @param string $request
     * @param array $params
     */
    public function catchParams(string $request, string $params)
    {

            $params = preg_match($params, $request, $results);

            if ($results) {
                $route->setParams($params);

            }

    }


    public function handleResquest(string $request)
    {
        foreach ($this->routes as $route) {
            if (!empty($params)){
                $this->catchParams($request, $route->getParams());
                $action = $this->actionResolver->create($route->getAction(), $route->getParams());
                return $action;
            }

            elseif ($route->getPath() === $request) {

                $action = $this->actionResolver->create($route->getAction());
              return $action;
            }

            $action = $this->actionResolver->create(NotFoundAction::class);
            return $action;
        }
    }
}
