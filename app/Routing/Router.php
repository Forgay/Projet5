<?php

namespace App\Routing;

use src\UI\Action\NotFoundAction;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    private $routes = [];
    private $actionResolver;
    private $request;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct(Request $request)
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
            $this->routes[] = new Route($route['path'], $route['action'], $route['params']);
        }

    }

    /**
     * @param string $request
     * @param string $params
     *
     */
    public function catchParams(string $request, string $params)
    {

        $params = preg_match($params, $request);

        if ($params) {
            $route->setParams($params);

        }
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {
        foreach ($this->routes as $route) {

            if (!empty($route->getParams()) && $route->getPath() === $request->server->get('REQUEST_URI')) {

                $this->catchParams($request->server->get('REQUEST_URI'), $route->getParams());

                $action = $this->actionResolver->create($route->getAction(), $request);

                $action();

            } elseif ($route->getPath() === $request->server->get('REQUEST_URI')) {

                $action = $this->actionResolver->create($route->getAction(), $request);

                $action();
            }
        }
    }
}
