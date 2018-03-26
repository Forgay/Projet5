<?php


namespace App\Routing;

use Src\UI\Action\NotFoundAction;

class Router
{
    private $routes = [];
    private $actionResolver;
    private $request;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->actionResolver = new ActionResolver();
        $this->request = $request;
        $this->loadRoutes();
        $this->handleRequest($request);
    }

    /**
     * Chargement des routes
     */
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

    /**
     * @param string $request
     *
     */
    public function handleRequest(string $request)
    {
        foreach ($this->routes as $route) {
            if (!empty($route->getParams())) {
                $this->catchParams($request, $route->getParams());
                $action = $this->actionResolver->create($route->getAction(), $route->getParams());
                echo $action();
            } elseif ($route->getPath() === $request) {

                $action = $this->actionResolver->create($route->getAction());
                echo $action();
            }

            $action = $this->actionResolver->create(NotFoundAction::class);
            echo $action();
        }
    }
}
