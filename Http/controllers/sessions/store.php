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
        redirect('/');
    }

    $form->hasError('email', 'No matching credentials found for that email address and password.');

}

// created an session errors that contains login form errors
//$_SESSION['errors'] = $form->errors();

//$_SESSION['_flash']['errors'] = $form->errors();


Session::flash('errors', $form->errors());

return redirect('/login');

//return view('sessions/create.view.php', [
//    'errors' => $form->errors()
//]);





