<?php


namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;
class LoginForm {

    public $attributes;
    protected $errors = [];


    public function __construct( array $attributes) {

        $this->attributes = $attributes;

        if(!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if(!Validator::password($attributes['password'])) {
            $this->errors['password'] = 'Please enter a valid password.';
        }

    }

    // for validating login form

    /**
     * @throws ValidationException
     */
    public static function validate($attributes) {

    // creating a new instance
    $instance = new static($attributes);

    // check if the validation failed and if it's success return the instance
    return $instance->failed() ? $instance->throw() : $instance;

    }

    // throw a customize error exception
    public function throw() {
        ValidationException::throw($this->errors(), $this->attributes);
    }



    // check if there's an error occur
    public function failed() {

        return count($this->errors);
    }


    // getters for the errors (get all the errors)
    public function errors() {

        return $this->errors;
    }

    // return specific error field
    public function hasError($field, $message) {

        $this->errors[$field] = $message;

        return $this;

    }


}


