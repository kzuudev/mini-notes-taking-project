<?php


use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);

$heading = "Edit Note";
$errors = [];

$id = $_GET['id'];
$currentUserId = 1;
$query = "select * from notes where id = :id";
$note = $db->query($query, ['id' => $id])->findOrFail();

view('notes/edit.view.php', [
    'errors' => $errors,
    'heading' => $heading,
    'note' => $note,
]);
