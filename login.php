<?php

    require './model/userModel.php';
    require './model/database.php';

    if(isset($_POST['email'],$_POST['password'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $valid = UserModel::login($email, $password);

        if(!$valid){
            $_SESSION['loginError'] = "Incorrect Username/Password";
        }

        

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

        <form action="login.php" method="post" class="form w-50 p-3 rounded bg-white">
            <div class="form-group">
                <label for="username" class="form-label m-0">Username</label>
                <input type="text" placeholder="Enter Email" name="email" class="form-control" required>
            </div>
            <div class="form-group mt-1">
                <label for="username" class="form-label m-0">Password</label>
                <input type="password" placeholder="Enter Password" name="pass" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Login</button>
        </form>
    </div>

</body>

</html>