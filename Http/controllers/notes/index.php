<?php

use Core\App;
use Core\Database;

$_SESSION['name'] = "John Kevin";

$db = App::resolve(Database::class);

$heading = "My Notes";

$notes = $db->query('select * from notes where user_id = 1')->findAll();

view('notes/index.view.php', [
    'heading' => $heading,
    'notes' => $notes,
]);
