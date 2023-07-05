<?php

/**
 *  Helper class to save login  
 *  base on session
 */

namespace lib;

session_start();

class Authentication
{

    static function start(){
        
    }

    static function login($user)
    {
        $_SESSION['login'] = $user->getId();
    }

    static function logout()
    {
        session_destroy();
    }

    static function islogin()
    {
        return isset($_SESSION['login']);
    }

    static function authorizeOnly(){
        if(!self::islogin()){
            $_SESSION['loginError'] = "login first!";
            header('location: /login.php');
        }
    }
}
