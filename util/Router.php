<?php

namespace util;

use exception\MethodNotAllowException;
use ReflectionMethod;
use constant\HttpMethod;
use exception\RouteNotFoundException;

class Router
{
    private static array $routers = [];
    private static string $delimiter = '@';

    public static function get($name, $option)
    {
        self::request(HttpMethod::GET, $name, $option);
    }

    public static function post($name, $option)
    {
        self::request(HttpMethod::POST, $name, $option);
    }

    public static function request($type, $name, $option)
    {
        $processorParams = explode(self::$delimiter, $option);
        if (count($processorParams) != 2) {
            echo 'Error setup router: ' . $name;
            exit;
        }
        $controller = $processorParams[0];
        $method = $processorParams[1];

        self::$routers[] = [
            'type' => $type,
            'name' => $name,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function go()
    {
        $url = $_SERVER['PATH_INFO'];

        foreach (self::$routers as $router) {
            if ($router['name'] == $url) {
                if ($_SERVER['REQUEST_METHOD'] == $router['type']) {
                    $class = 'controller' . '\\' . $router['controller'];
                    $object = new $class;


                    $method = $router['method'];

                    $reflectionMethod = new ReflectionMethod($class, $method);

                    //Get the parameters of a method
                    $parameters = $reflectionMethod->getParameters();

                    //Loop through each parameter and get the type
                    $passedParams = [];
                    foreach ($parameters as $param) {
                        //Before you call getClass() that class must be defined!
                        $className = $param->getClass()->name;
                        $passedParams[] = new $className();
                    }

                    // process
                    $reflectionMethod->invokeArgs(new $class, $passedParams);
                    return;
                } else {
                    throw new MethodNotAllowException($_SERVER['REQUEST_METHOD']);
                }
            }
        }
        throw new RouteNotFoundException($url);
    }
}
