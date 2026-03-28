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

    // if the validation failed
    if($instance->failed()) {
        ValidationException::throw($instance->errors(), $instance->attributes);
    }

    // if it's success return the instance
    return $instance;

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

        return $this->errors[$field] = $message;
    }


}


