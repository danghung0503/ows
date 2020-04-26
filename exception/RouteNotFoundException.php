<?php

namespace exception;
use RuntimeException;
use Throwable;

class RouteNotFoundException extends RuntimeException
{
    public function __construct($url = "")
    {
        parent::__construct('Route not found exception: '.$url);
    }
}
