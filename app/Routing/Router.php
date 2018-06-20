<?php

namespace App\Routing;

use Src\UI\Action\NotFoundAction;
use Src\UI\Action\ServerError;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SecuredService;

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var ActionResolver
     */
    private $actionResolver;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var SecuredService
     */
    private $secured;

    /**
     * Router constructor.
     *
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
     * @param $uri
     * @param Route $route
     * @param Request $request
     */
    public function catchParams($params, $uri, Route $route, Request $request)
    {
        $path = $route->getPath();

        foreach ($params as $value => $param) {

            if ($value === "token"){
                $numpos = strrpos($uri, "/");
                preg_match($param, $uri, $results,PREG_OFFSET_CAPTURE,$numpos);
                $result = $results[0];

            } else {

                preg_match($param, $uri, $result);
            }


            if ($result && array_key_exists($value, $params)) {

                $newPath = strtr($path, ["{".$value."}" => $result[0]]);
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

            if (empty($request->server->get('REQUEST_METHOD'))) {

                $action = new ServerError();

                return $action();
            }

            //$this->secured->catchSecured($route->getSecured() ?? false, $request->getSession());

            $this->catchParams($route->getParams(), $request->server->get('REQUEST_URI'), $route, $request);

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
