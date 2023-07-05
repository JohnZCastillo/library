<?php

/**
 *  Helper class to save login  
 *  base on session
 */

namespace lib;

session_start();

class Authentication
{


    static function login($user)
    {
        $_SESSION['login'] = $user;
    }

    static function logout()
    {
        session_destroy();
    }

    static function islogin()
    {
        return isset($_SESSION['login']);
    }
}
