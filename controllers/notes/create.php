<?php

use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);


$heading = "Create Note";
$errors = [];


view('notes/create.view.php', [
    'errors' => [],
    'heading' => $heading,
]);
