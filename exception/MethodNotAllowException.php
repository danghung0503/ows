<?php


namespace exception;
use RuntimeException;

class MethodNotAllowException extends RuntimeException
{
    public function __construct($method = "")
    {
        parent::__construct('Method not allow exception: '.$method);
    }
}
