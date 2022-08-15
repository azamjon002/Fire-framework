<?php

namespace app\base;

class Router
{
    public Request $request;
    public Response $response;
    public array $routes =[];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response = new Response();
    }

    public function get($url, $callback)
    {
        $this->routes['get'][$url]=$callback;
    }

    public function post($url, $callback)
    {
        $this->routes['post'][$url]=$callback;
    }

    public function view(string $view, $data = [])
    {
        $layout = $this->layout_base();
        $content = $this->layout_content($view, $data);
        return str_replace('{{content}}', $content, $layout);
    }

    public function layout_content(string $view, $data=[])
    {
        foreach ($data as $key=>$datum) {
            $$key = $datum;
        }
        ob_start();
        include "../views/$view.php";
        return ob_get_clean();
    }

    public function layout_base()
    {
        $layout = Fire::$fire->controller->layout;
        ob_start();
        include "../views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function resolve()
    {
        $url = $this->request->getUrl();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$url]?? false;

        if (!$callback){
            Fire::$fire->controller->setLayout('_blanc');
            Fire::$fire->response->setStatusCode('404');
           return $this->view('errors/404');
        }else{

            if (is_string($callback)){
                return $this->view($callback);
            }
            if (is_array($callback)){
                $callback[0] = new $callback[0]();
                Fire::$fire->controller = $callback[0];

                Fire::$fire->controller->action = $callback[1];

                foreach (Fire::$fire->controller->middlewares as $middleware) {
                    $middleware->tekshiruv();
                }
            }

            call_user_func($callback, $this->request, $this->response);
        }
    }
}