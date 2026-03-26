<?php



namespace Core;


class Session {


    // return existing session key (array)
    public static function has($key) {
        return (bool) static::get($key);
    }

    // input a new array in Session
    public static function put($key, $value) {
        $_SESSION[$key] = $value;
    }

    // get existing array in Session
    public static function get($key) {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? null;
    }


    // setting up the session I want to flash
    public static function flash($key, $value) {
        $_SESSION['_flash'][$key] = $value;

    }

    // to delete/expire/flash the entire session
    public static function unflash() {
        unset($_SESSION['_flash']);
    }


    // Empty the entire session
    public static function flush() {

        $_SESSION = [];
    }


    // destroy session
    public static function destroy() {
        static::flush();


        session_destroy();

        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }





}