<?php

namespace app\base;

class Router
{
    public Request $request;
    public array $routes =[];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($url, $callback)
    {
        $this->routes['get'][$url]=$callback;
    }

    public function post($url, $callback)
    {
        $this->routes['post'][$url]=$callback;
    }

    public function view(string $view)
    {
        ob_start();
        include "../views/$view.php";
        return ob_get_clean();
    }

    public function resolve()
    {
        $url = $this->request->getUrl();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$url]?? false;

        if (!$callback){
            echo "Not Found!";
        }else{

            if (is_string($callback)){
                return $this->view($callback);
            }
            call_user_func($callback);
        }
    }
}