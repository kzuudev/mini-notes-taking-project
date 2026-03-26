<?php


use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$form = new LoginForm();
$auth = new Authenticator();


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// it validate the input in the form first.
if($form->validate($email, $password)) {
    // then, if it validate try to authenticate it
    if ($auth->attempt($email, $password)) {
        Session::put('user', [
            'email' => $email
        ]);
        redirect('/');
    }

    $form->hasError('email', 'No matching credentials found for that email address and password.');

}


Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $email
]);


return redirect('/login');






