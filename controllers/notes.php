<?php

$config = require('config.php');
$db = new Database($config['database']);


$heading = "Notes";

$notes = $db->query('select * from notes where user_id = 3')->findAll();

// var_dump($notes);

require "views/notes.view.php";
