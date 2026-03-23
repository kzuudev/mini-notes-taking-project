<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);


$heading = "Note";

$id = $_GET['id'];
$query = "select * from notes where id = :id";
$currentUserId = 1;

$note = $db->query($query, ['id' => $id])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
    'heading' => $heading,
    'note' => $note,
]);

