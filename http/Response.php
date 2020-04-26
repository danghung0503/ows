<?php


namespace http;


class Response
{
    private static Response $response;
    public function json($data){
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public static function getInstance(){
        if(empty(self::$response)) {
            self::$response = new Response();
        }
        return self::$response;
    }
}
