<?php

require_once './autoload.php';

use model\UserModel;
use model\Database;
use lib\Redirect;

// handle post request
if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // open database connection
    $connection = Database::open();

    // create user model
    $userModel = new UserModel($connection);

    $userModel->setName($name);
    $userModel->setEmail($email);
    $userModel->setPassword($password);
    $userModel->setRole('user');

    try {
        // save user
        $userModel->save();
        header('location: login.php');
        die();
    } catch (Exception $e) {
        //reach this line if not authorized
        $_SESSION['signUpError'] = $e->getMessage();
    }

} else {
    unset($_SESSION['signUpError']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inlcude header -->
    <?php include './partials/header.php'; ?>
    <title>login</title>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-dark">

        <form action="signup.php" method="post" class="form w-50 p-3 rounded bg-white">
            <div class="form-group">
                <label for="username" class="form-label m-0">Name</label>
                <input type="text" placeholder="Enter Name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username" class="form-label m-0">Email</label>
                <input type="text" placeholder="Enter Email" name="email" class="form-control" required>
            </div>
            <div class="form-group mt-1">
                <label for="username" class="form-label m-0">Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Sign Up</button>

            <div class="form-group text-center small text-danger">
                <?php
                if (isset($_SESSION['signUpError'])) {
                    echo $_SESSION['signUpError'];
                }
                ?>
            </div>
        </form>
    </div>

</body>

</html>