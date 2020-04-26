<?php
require 'bootstrap/autoload.php';
use util\Router;

try {
    $router = new Router();
    $router->go();
}catch (Exception $ex) {
    echo $ex->getMessage();
}
