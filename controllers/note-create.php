<?php

$config = require('config.php');
$db = new Database($config['database']);


$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);

    $errors = [];

    if (strlen($_POST['title']) === 0) {
        $errors['title'] = 'A title is required';
    }

    if (strlen($_POST['body']) === 0) {
        $errors['body'] = 'A body is required';
    }

    if (strlen($_POST['body']) > 1000) {
        $errors['body'] = 'The body can not be more than 1,000 characters';
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

require 'views/note-create.view.php';
