<?php


use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::emailLogin($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (! Validator::password($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if(! empty($errors)) {
    return view('sessions/create.view.php', [
        'errors' => $errors,
    ]);
}

$user = $db->query("select * from users where email = :email", [
    'email' => $email
])->find();

if($user == login()) {}
