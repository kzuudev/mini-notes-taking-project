<?php

// $routes = [
//     '/' => 'controllers/index.php',
//     '/about' => 'controllers/about.php',
//     '/notes' => 'controllers/notes/index.php',
//     '/note'  => 'controllers/notes/show.php',
//     '/create' => 'controllers/notes/create.php',
//     '/contact' => 'controllers/contact.php',
// ];


$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');
$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');

$router->get('/create', 'controllers/notes/create.php');
