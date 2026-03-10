<?php

$config = require('config.php');
$db = new Database($config['database']);


$heading = "Note";

$id = $_GET['id'];
$query = "select * from notes where id = :id";
$currentUserId = 3;

$note = $db->query($query, ['id' => $id])->findOrFail();

// for page not found
// if (!$note) {
//     abort();
// }

authorize($note['user_id'] === $currentUserId);

// for unathorized user to view specific notes
// if($note['user_id'] != 1) {
//     abort(Response::FORBIDDEN);
// }

require "views/note.view.php";
