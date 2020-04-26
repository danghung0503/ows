<?php


namespace base\middleware;


use http\Request;

 abstract class Middleware
{
    private array $except;

    public function except($routes){
        $this->except = $routes;
    }

    public function process(Request $request){
        if(!in_array($_SERVER['PATH_INFO'], $this->except)) {
            return $this->handler($request);
        }
        return true;
    }
    public abstract function handler(Request $request);

}
