<?php


namespace Http\Forms;

use Core\Validator;

class RegisterForm {

    protected $errors = [];


    public function validate($name, $email, $password) {

        if (! Validator::string($name, 1, 20)) {

            $this->errors['name'] = 'Name is required and can not be more than 20 characters.';
        }

        if (! Validator::string($email, 1, 20)) {
            $this->errors['email'] = 'Email is required and can not be more than 20 characters.';
        }


        if (! Validator::password($password, 1, 15)) {

            $this->errors['password'] = "Password is required and can not be less than 15 characters.";
        }

        return empty($this->errors);

    }

    public function errors() {

        return $this->errors;
    }

    public function hasError($field, $message) {

        return $this->errors[$field] = $message;

    }
}


