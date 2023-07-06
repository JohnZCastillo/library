<?php

require_once './autoload.php';

use model\UserModel;
use model\Database;
use lib\Redirect;
use lib\Authentication;

Authentication::start();

// handle post request
if (isset($_POST['email'], $_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // open database connection
    $connection = Database::open();

    // create user model
    $userModel = new UserModel($connection);

    //check credentials
    $user =  $userModel->login($email, $password);

    //authorized
    if ($user) {
        Authentication::login($user);
        Redirect::redirect();
        die();
    }

    //reach this line if not authorized
    $_SESSION['loginError'] = "Incorrect Username/Password";
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inlcude header -->
    <?php include './partials/header.php'; ?>
    <title>Login</title>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-dark">

        <form action="login.php" method="post" class="form w-50 p-3 rounded bg-white">
            <h6 class="display-6">Log In</h6>
            <div class="form-group">
                <label for="username" class="form-label m-0">Email</label>
                <input type="text" placeholder="Enter Email" name="email" class="form-control" required>
            </div>
            <div class="form-group mt-1">
                <label for="username" class="form-label m-0">Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Login</button>

            <a href="./signup.php" class="text-decoration-none text-secondary d-block text-center">sign up</a>
            <div class="form-group text-center small text-danger">
                <?php
                if (isset($_SESSION['loginError'])) {
                    echo $_SESSION['loginError'];
                }
                ?>
            </div>

            
        </form>
    </div>

</body>

</html>