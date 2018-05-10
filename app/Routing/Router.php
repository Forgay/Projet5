<?php

namespace App\Routing;

use Src\UI\Action\NotFoundAction;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SecuredService;


class Router
{
    private $routes = [];
    private $actionResolver;
    private $request;
    private $secured;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->actionResolver = new ActionResolver();
        $this->secured = new SecuredService();
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
            $this->routes[] = new Route($route['path'], $route['action'], $route['params'], $route['secured'] ?? false);
        }

    }

    /**
     * @param $params
     * @param $request
     * @param null $result
     */
    public function catchParams($params, $uri, Route $route, Request $request)
    {
        $path = $route->getPath();

        foreach ($params as $value => $param) {

            preg_match($param, $uri, $result);

            if ($result && array_key_exists($value, $params)) {

                $newPath = strtr($path, ['{' . $value . '}' => $result[0]]);
                $route->setPath($newPath);
                $request->attributes->add($result);
            }
        }

    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request)
    {

        foreach ($this->routes as $route) {

            $this->secured->catchSecured($route->getSecured(),$request->getSession());
            $this->catchParams($route->getParams(), $request->server->get('REQUEST_URI'), $route, $request);

              if (!empty($route->getParams()) && $route->getPath() === $request->server->get('REQUEST_URI')) {

              $action = $this->actionResolver->create($route->getAction(),$request);

              return $action();

              } elseif ($route->getPath() === $request->server->get('REQUEST_URI')) {

              $action = $this->actionResolver->create($route->getAction(),$request);

              return $action();

              }
        }
        $action = new NotFoundAction();

        return $action();
    }
}
