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
                echo $this->renderError404Page();
            }

        }
        function renderError404Page()
        {
            $html = '
                <!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Página não encontrada</title>
                    <style>
                        body {
                            background-color: #f8f9fa;
                            font-family: Arial, sans-serif;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                        }

                        .error-container {
                            text-align: center;
                        }

                        .error-image {
                            max-width: 100%;
                            height: auto;
                        }

                        h1 {
                            color: #dc3545;
                            font-size: 4em;
                        }

                        p {
                            font-size: 1.2em;
                            color: #555;
                        }

                        a {
                            color: #007bff;
                            text-decoration: none;
                            font-weight: bold;
                        }

                        a:hover {
                            text-decoration: underline;
                        }
                    </style>
                </head>
                <body>
                    <div class="error-container">
                        <img class="error-image" src="/src/4835105_404_icon.png" alt="Erro 404 - Página não encontrada">
                        <h1>Oops! Página não encontrada</h1>
                        <p>A página que você está procurando não foi encontrada. <br>Verifique o URL ou <a href="/">volte para a página inicial</a>.</p>
                    </div>
                </body>
                </html>';

            return $html;
        }

    }

?>
