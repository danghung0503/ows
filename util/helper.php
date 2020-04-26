<?php
use http\Response;

// using delimiter is '.' character
function config($path){
    $database = include 'config/database.php';
    $jwt = include 'config/jwt.php';
    $config = [
        'database' => $database,
        'jwt' => $jwt,
    ];

    $params = explode('.', $path);
    $res = $config;
    foreach($params as $param) {
        if (isset($res[$param])) {
            $res = $res[$param];
        }else {
            echo 'Cannot find config: '.$path;
        }
    }
    return $res;
}

/**
 * use for return api result
 * @return Response
 */
function response(){
    return Response::getInstance();
}
