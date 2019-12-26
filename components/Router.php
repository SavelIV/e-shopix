<?php

/**
 * Class Router
 * Works with routes
 */
class Router
{

    /**
     * Variable for storing an array of routes
     * @var array 
     */
    private $routes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';

        $this->routes = include($routesPath);
    }

    /**
     * Returns query string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        } 
    }

    /**
     * Method to handle requests
     */
    public function run()
    {
        // get request string
        $uri = $this->getURI();

        // check if it exists in routes.php
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {

                // get internal route ($path) according to this rule
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                // define controller, action, parameters
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
               
                // include controller file
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
 
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object, call method with given parameters
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }

}
