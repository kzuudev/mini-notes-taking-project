<?php

namespace Core;
use Exception;


class ValidationException extends \Exception {


//    public $errors = [];
//    public $old = [];

    public array $errors;
    public array $oldAttributes;
    public static function throw($errors, $oldAttributes) {

        $instance = new static;

        $instance->errors = $errors;
        $instance->oldAttributes = $oldAttributes;

        throw $instance;

    }


}