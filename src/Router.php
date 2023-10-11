<?php

    namespace danieltm\restrouter;

    class Router{
        private $routes = [];

        public function get($path, $callback)
        {
            $this->routes[] = ['method' => 'GET', 'path' => $path, 'callback' => $callback];
        }

        public function post($path, $callback)
        {
            $this->routes[] = ['method' => 'POST', 'path' => $path, 'callback' => $callback];
        }

        public function run(){
            $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestPathexpected = $requestPath;

            foreach ($this->routes as $route) {
                $padrao = "/\{([^}]+)\}/";
                $varId = null;
                $indexOf = 0;
                if(preg_match($padrao, $route['path'], $correspondencias)){
                    $varId = $correspondencias[1];
                    $indexOf = strpos($route['path'], "{");
                    $route["path"] = substr($route['path'], 0, $indexOf);
                    $requestPathexpected = substr($requestPath,0, $indexOf);

                }
                if ($route['method'] == $requestMethod && $route['path'] == $requestPathexpected) {

                    if(isset($varId)){
                        $server = [
                            "request" => [
                                "body" => file_get_contents("php://input"),
                                "header" => getallheaders()
                            ],
                            "$varId" => substr($requestPath, $indexOf, strlen($requestPath))
                        ];
                    }else{
                        $server = [
                            "request" => [
                                "body" => file_get_contents("php://input"),
                                "header" => getallheaders()
                            ],
                        ];
                    }

                    call_user_func($route['callback'], $server);
                    return;
                }
                http_response_code(404);
                echo "Página não encontrada.";
            }

        }
    }

?>
