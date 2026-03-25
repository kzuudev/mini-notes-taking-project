<?php

namespace Core;

use Core\Session;

class Authenticator {

    public function attempt($email, $password) {

        $db = App::resolve(Database::class);

        // check if the email provided by the user is existing in the database
        $user = $db->query("select * from users where email = :email", [
            'email' => $email
        ])->find();

        // if the user email and password matched the credentials in the database, allowed to log in.
        if($user) {
            if(password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                return true;
            }


        }

        return false;
    }

    public function login($user) {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        //regenerating ID here to prevent session fixation hackers (for security)
        session_regenerate_id();
        header('location: /');
        exit();
    }

    public function logout() {

        Session::destroy();

        redirect("/");
    }
}