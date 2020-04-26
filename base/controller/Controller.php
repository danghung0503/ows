<?php
namespace base\controller;

class Controller
{
    private string $middleware;
    protected function middleware($middleware){
        $this->middleware = $middleware;
    }
}
