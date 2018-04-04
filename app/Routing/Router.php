<?php

namespace App\Routing;

use src\UI\Action\NotFoundAction;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    private $routes = [];
    private $actionResolver;
    private $request;
    private $result;

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
            $this->routes[] = new Route($route['path'], $route['action'], \is_array($route['params']) ? $route['params'] : []);
        }

    }

    /**
     * @param $params
     * @param $request
     * @param null $result
     */
    public function catchParams($params, $request)
    {
        foreach ($params as $value) {
            return $value;
        }
            preg_match($value, $request, $result);



        if (isset($result)) {
            foreach ($this->routes as $route) {
                $route->setParams($result);
            }
        }
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {
        foreach ($this->routes as $route) {

            $this->catchParams($route->getParams(), $request->server->get('REQUEST_URI'));

            if (!empty($route->getParams()) && $route->getPath() === $request->server->get('REQUEST_URI')) {

                $action = $this->actionResolver->create($route->getAction(), $request);

                $action();

            } elseif ($route->getPath() === $request->server->get('REQUEST_URI')) {

                $action = $this->actionResolver->create($route->getAction(), $request);

                $action();
            }
        }
    }
}
