<?php

namespace app\core;

/**
 * Class Router
 *
 */

class Router
{
    public Response $response;
     public Request $request;
    protected array $routes = [];

    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
        // var_dump($callback);
    }

    // resolve function handles the path and call backs and is called in the run function in app
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        // var_dump($method);
        // var_dump($path);
        // var_dump($callback);
        if ($callback === false) {
            $this->response->serStatusCode(404);
            return "Not found";
        }
        if (is_string($callback)) {
            return $this->renderView($callback);

        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view){
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
