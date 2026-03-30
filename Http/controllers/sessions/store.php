<?php

namespace Http\Controllers\Sessions;
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Session;
use Core\ValidationException;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];
$db = App::resolve(Database::class);



$auth = new Authenticator();


// it validates the input in the form first.
$form = LoginForm::validate($attributes = [
        'email' => $email,
        'password' => $password
]);

// then, if it's validated try to authenticate it
$attemptSignedIn = $auth->attempt($attributes['email'], $attributes['password']);

if(! $attemptSignedIn) {
    $form->hasError('email', 'No matching credentials found for that email address and password.');
    ValidationException::throw($form->errors(), $form->attributes);
}

// it it's authenticated, create a session user for authentication and return it in home page
Session::put('user', [
    'email' => $email
]);
redirect('/');







