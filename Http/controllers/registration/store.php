<?php


use Core\Database;
use Core\Validator;
use Core\App;
use Http\Forms\RegisterForm;
use Core\Authenticator;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];



$register = new RegisterForm();
$auth = new Authenticator();

$db = App::resolve(Database::class);


if($register->validate($name, $email, $password)) {

    // check if the email already exists in the database
    $user = $db->query("select * from users where email = :email", [
        'email' => $email
    ])->find();

    // then if someone with that email already exists and has an account.
    // if yes, redirect to login page
    if($user) {

        $register->hasError('email', 'An account with this email already exists.');

        // 2. Stop executing and return the view with ALL errors
        return view('registration/create.view.php', [
            'errors' => $register->errors()
        ]);


    }


    //If not, save one to the database, and then log the user in, and redirect.
    $db->query("INSERT into users(name, email, password) VALUES (:name, :email, :password)", [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    redirect("/login");




}

return view('registration/create.view.php', [
    'errors' => $register->errors()
]);

//if($user) {
//    // then if someone with that email already exists and has an account.
//    // if yes, redirect to login page
//    header('location: /');
//    exit();
//}else {
//
//    //If not, save one to the database, and then log the user in, and redirect.
//    $db->query("INSERT into users(name, email, password) VALUES (:name, :email, :password)", [
//        'name' => $name,
//        'email' => $email,
//        'password' => password_hash($password, PASSWORD_BCRYPT),
//    ]);
//
////    $_SESSION['user'] = [
////        'name' => $name,
////        'email' => $email,
////    ];
//
//    login([
//        'email' => $email,
//    ]);
//}





