<?php

use Core\Session;
use Core\ValidationException;

session_start();
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';
require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . 'Core/Session.php';

$router = new \Core\Router();
require base_path('routes.php');
require base_path('bootstrap.php');


$raw_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/notes-mini', '', $raw_uri);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



try {
    $router->route($uri, $method);
}catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->oldAttributes);

    return redirect($router->previousUrl());
}


Session::unflash();