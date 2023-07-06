<?php

/**
 *  Helper class to redirect url 
 *  base on user role
 */

namespace lib;

class Redirect
{

    static function redirect()
    {
        if($_SESSION['role'] == 'admin'){

            header("Location: ./admin.php");
        }else{
            header("Location: ./user.php");

        }
    }
}
