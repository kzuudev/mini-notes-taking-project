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

//$form = new LoginForm();

try {
    // it validates the input in the form first.
    $form = LoginForm::validate($attributes = [
        'email' => $email,
        'password' => $password
    ]);

    // then, if it's validated try to authenticate it
    if ($auth->attempt($attributes['email'], $attributes['password'])) {
        Session::put('user', [
            'email' => $email
        ]);
        redirect('/');
    }

    $form->hasError('email', 'No matching credentials found for that email address and password.');
    ValidationException::throw($form->errors(), $form->attributes);


}catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->oldAttributes);

    return redirect('/login');
}





return redirect('/login');






