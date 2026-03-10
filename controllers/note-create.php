<?php

$config = require('config.php');
$db = new Database($config['database']);


$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);

    $sql = "INSERT INTO notes(title, body, user_id) VALUES (:title, :body, :user_id)";

    $db->query($sql, [
        'title' => $_POST['title'],
        'body' => $_POST['body'],
        'user_id' => 3,
    ]);
}

require 'views/note-create.view.php';
