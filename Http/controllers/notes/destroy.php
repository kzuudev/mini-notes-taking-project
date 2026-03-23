<?php


use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$id = $_POST['id'];
$query = "select * from notes where id = :id";
$currentUserId = 1;

$note = $db->query($query, ['id' => $id])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query("delete from notes where id = :id", [
    'id' => $id
]);

header("location: /notes");
exit();
