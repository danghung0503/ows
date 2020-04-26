<?php
namespace base\controller;

use base\middleware\Middleware;

class Controller
{
    private Middleware $middleware;
    protected function middleware($middleware){
        $this->middleware = $middleware;
        return $this->middleware;
    }

    public function getMiddleware(){
        return $this->middleware;
    }
}
