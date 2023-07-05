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
        header("Location: /user.php");
    }
}
