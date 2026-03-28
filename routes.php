<?php


$router = new Core\Router();

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');
$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');

$router->get('/create', 'controllers/notes/create.php');
$router->post('/note/create', 'controllers/notes/store.php');
$router->get('/note/edit', 'controllers/notes/edit.php');
$router->delete('/note/destroy', 'controllers/notes/destroy.php');
$router->patch('/note/update', 'controllers/notes/update.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register/create', 'controllers/registration/store.php');
$router->delete('/register/destroy', 'controllers/registration/destroy.php');
$router->patch('/register/update', 'controllers/registration/update.php');

$router->get('/login', 'controllers/sessions/create.php')->only('guest');;
$router->post('/sessions/create', 'controllers/sessions/store.php')->only('guest');
$router->delete('/sessions/destroy', 'controllers/sessions/destroy.php')->only('auth');


