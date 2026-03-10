<?php

function urlIs($value) {
    $raw_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    

    // $uri = str_replace('/notes-mini', '', $raw_uri);
    // var_dump($uri);

    // return $uri === $value;

    return $raw_uri === $value;
}


function authorize($condition, $status = Response::FORBIDDEN) {

    if(! $condition) {
        abort($status);
    }
}



?>