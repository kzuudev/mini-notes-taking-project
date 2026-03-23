<?php


use Core\Database;
use Core\Validator;
use Core\App;


$db = App::resolve(Database::class);

//find the corresponding note
$id = $_POST['id'];
$query = "select * from notes where id = :id";
$currentUserId = 1;

$note = $db->query($query, ['id' => $id])->findOrFail();


// authorize that the current user id is authorize to access the note
authorize($note['user_id'] === $currentUserId);

// validation form
$errors = [];

if (! Validator::string($_POST['title'], 1, 20)) {
    $errors['title'] = 'A title is required and can not be more than 20 characters.';
}

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'The body can not be empty and more than 1,000 characters.';
}


// if no validation errors, update the record in the notes database table
if(empty($errors)) {
    $sql = "UPDATE notes SET title = :title, body = :body WHERE id = :id";

    $db->query($sql, [
        'title' => $_POST['title'],
        'body' => $_POST['body'],
        'id' => $id,
    ]);
}

header("location: /notes");
die();