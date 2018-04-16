<?php

namespace App\Routing;

use Src\UI\Action\NotFoundAction;
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
     * @param $params
     * @param $request
     * @param null $result
     */
    public function catchParams($params, $uri, Route $route,Request $request)
    {

        foreach ($params as $value) {

            preg_match($value, $uri, $result);

        }
        if (isset($result[0])) {

                $route->setPath($uri);
                $request->attributes->add($result);

        }
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {

        foreach ($this->routes as $route) {

            $this->catchParams($route->getParams(), $request->server->get('REQUEST_URI'),$route,$request);

            if (!empty($route->getParams()) && $route->getPath() === $request->server->get('REQUEST_URI')) {

                $action = $this->actionResolver->create($route->getAction(), $request);

               return $action();

            } elseif ($route->getPath() === $request->server->get('REQUEST_URI')) {

                $action = $this->actionResolver->create($route->getAction(), $request);

               return $action();
            }

        }
        $action = new NotFoundAction();
       return $action();
    }
}
