<?php

require 'routes.php';
$raw_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$uri = str_replace('/notes-mini', '', $raw_uri);
// var_dump($uri);
// echo "<br>";


// var_dump(array_keys($routes));

function routeToController($uri, $routes) {

    if(array_key_exists($uri, $routes)) {
        require $routes[$uri];
    }else {
        abort();
    }
}

function abort($code = 404) {
    http_response_code($code);

    require "views/{$code}.php";
    
    die();
}


routeToController($uri, $routes);



?>