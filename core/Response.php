<?php
namespace app\core;

class Response {
    public function serStatusCode(int $code){
        http_response_code($code);
    }
}