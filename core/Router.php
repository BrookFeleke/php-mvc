<?php

namespace app\core;

/** 
 * Class Router
 * 
*/

class Router{
    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request){
        $this->request = $request;
    }
  

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
        // var_dump($callback);
    }

    public function resolve(){
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$path] ?? false ;
    var_dump($method);
    var_dump($path);
    var_dump($callback);
    if($callback === false ){
        echo "Not found";
    }
    echo call_user_func($callback);
    }

}
