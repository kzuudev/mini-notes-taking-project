<?php


namespace Http\Forms;

use Core\Validator;

class LoginForm {

    protected $errors = [];

    public function validate($email, $password) {

        if(! Validator::email($email)) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if(! Validator::password($password)) {
            $this->errors['password'] = 'Please enter a valid password.';
        }

        return empty($this->errors);

    }

    // getters for the errors
    public function errors() {

        return $this->errors;
    }

    public function hasErrors($field, $message) {

        return $this->errors[$field] = $message;
    }


}


