<?php

require_once './autoload.php';

use lib\Authentication;

Authentication::logout();

header('location: ./login.php');
