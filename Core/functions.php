<?php

use Core\Response;

function urlIs($value)
{
    $raw_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


    $uri = str_replace('/notes-mini', '', $raw_uri);
    // var_dump($uri);

    return $uri === $value;
}

function abort($code = 404)
{

    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}


function authorize($condition, $status = Response::FORBIDDEN)
{

    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{

    return BASE_PATH . $path;
}


function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

function login($user) {
    $_SESSION['user'] = [
        'email' => $user['email'],
    ];

    // regenerating ID here to prevent session fixation hackers (for security)
    session_regenerate_id();
    header('location: /');
    exit();

}

function logout() {

    $_SESSION = [];

    // destroy the temporary session file in the server
    session_destroy();


    $params = session_get_cookie_params();

    setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    header('location: /');
    exit();
}