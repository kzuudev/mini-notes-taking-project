<?php

use Core\Session;

session_start();
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';


$router = new \Core\Router();

spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');
require base_path('routes.php');

$raw_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/notes-mini', '', $raw_uri);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);


Session::unflash();