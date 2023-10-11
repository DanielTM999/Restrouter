<?php

use danieltm\restrouter\Router;

    include "./src/Router.php";

    $app = new Router;

    $app->get("/", function(){
        echo "/";
    });

    $app->run();
