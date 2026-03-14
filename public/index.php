<?php


const BASE_PATH = __DIR__ . '/../';
// var_dump(BASE_PATH);

// require BASE_PATH . 'functions.php';
require BASE_PATH . 'Core/functions.php';


spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
    // require base_path("Core/{$class}.php");
});

require base_path('Core/router.php');
