<?php



use Core\Database;
use Core\Validator;
use Core\App;


$db = App::resolve(Database::class);
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// check if there's an error occurred in form
$errors = [];

if (! Validator::string($_POST['name'], 1, 20)) {

    $errors['name'] = 'Name is required and can not be more than 20 characters.';
}

if (! Validator::email($_POST['email'], 1, 20)) {
    $errors['email'] = 'Email is required and can not be more than 20 characters.';
}

if (! Validator::password($_POST['password'], 1, 30)) {

    $errors['password'] = "Password is required and can not be less than 30 characters.";
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if the email already exists in the database
$user = $db->query("select * from users where email = :email", [
    'email' => $email
])->find();

if($user) {
    // then someone with that email already exists and has an account.
    // if yes, redirect to login page
    header('location: /');
    exit();
}else {

    //If not, save one to the database, and then log the user in, and redirect.
    $db->query("INSERT into users(name, email, password) VALUES (:name, :email, :password)", [
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
    ];
}

// If there's no error insert it to the database.
//if(empty($errors)) {
//
//    $sql = "INSERT into users(name, email, password) VALUES (:name, :email, :password)";
//
//}




