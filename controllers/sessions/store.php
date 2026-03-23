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

// check if the email provided by the user is existing in the database
$user = $db->query("select * from users where email = :email", [
    'email' => $email
])->find();

if(! $user) {
    return view('sessions/create.view.php', [
        'errors' => [
            'email' => 'The email address you provided does not exist in our database.'
        ]
    ]);
}

// we have a user, but we don't know if the password provided matches what we have in the database
if(! password_verify($password, $user['password']  )) {
    return view('sessions/create.view.php', [
        'errors' => [
            'password' => 'The password you provided is incorrect.'
        ]
    ]);
}

// if the user email and password matched the credentials in the database, allowed to log in.
login([
    'email' => $email,
]);

