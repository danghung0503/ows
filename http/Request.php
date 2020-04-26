<?php

namespace http;

use constant\HttpMethod;

class Request
{
    private string $type;

    public function __construct()
    {
        $this->type = $_SERVER['REQUEST_METHOD'];
    }

    public function get($field)
    {
        if ($this->type == HttpMethod::GET) {
            return $_GET[$field];
        } else if ($this->type == HttpMethod::POST) {
            $data = json_decode(file_get_contents('php://input'), true);
            return $data[$field];
        }
        return null;
    }

    /**
     * @param $field: field need to get value from header
     * @return string: value of field in header
     */
    public function getHeader($field)
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers[$field];
    }
}
