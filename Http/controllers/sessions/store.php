<?php


use Core\App;
use Core\Database;
use Core\Authenticator;
use Http\Forms\LoginForm;

$form = new LoginForm();
$auth = new Authenticator();


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];


if($form->validate($email, $password)) {
    if($auth->attempt($email, $password)) {
        redirect('/');
    }

    $form->hasErrors('email', 'No matching credentials found for that email address and password.');
}

return view('sessions/create.view.php', [
    'errors' => $form->errors()
]);




