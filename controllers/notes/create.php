<?php

use Core\Database;
use Core\Validator;


$config = require base_path('config.php');
$db = new Database($config['database']);


$heading = "Create Note";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);

    if (! Validator::string($_POST['title'], 1, 20)) {
        $errors['title'] = 'A title is required and can not be more than 20 characters.';
    }

    if (! Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'The body can not be empty and more than 1,000 characters.';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO notes(title, body, user_id) VALUES (:title, :body, :user_id)";

        $db->query($sql, [
            'title' => $_POST['title'],
            'body' => $_POST['body'],
            'user_id' => 3,
        ]);
    }
}



view('notes/create.view.php', [
    'heading' => $heading,
]);
