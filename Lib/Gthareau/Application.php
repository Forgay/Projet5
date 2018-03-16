<?php


namespace Gthareau;


class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
        $this->httpResponse = new HttpResponse();
        $this->name = '';
    }

    public function getController()
    {
        $router = new Router;

        $xml = new \DOMDocument;
        $xml->load(__DIR__ . '/../../App/config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        // On parcourt les routes du fichier XML.
        foreach ($routes as $route) {
            $vars = [];

            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // On ajoute la route
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $route->getAttribute('layout'), $vars));
        }

        try {
            // On récupère la route correspondante à l'URL.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                $this->httpResponse->redirect404();
            }
        }

        // On ajoute les variables de l'URL au tableau $_GET.
        $_GET = array_merge($_GET, $matchedRoute->getVars());

        // On instancie le contrôleur.
        $controllerClass = 'App\\Modules\\' . $matchedRoute->getModule() . '\\' . $matchedRoute->getModule() . 'Controller';
        return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction(), $matchedRoute->getLayout());
    }


    public function run()
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }

    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function getName()
    {
        return $this->name;
    }
}