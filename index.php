<?php


require_once './autoload.php';

use lib\Authentication;
use lib\Redirect;

if (Authentication::islogin()) {
    Redirect::redirect();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <!-- Inlcude header -->
    <?php include './partials/header.php'; ?>
</head>

<body>

    <main class="container-fluid py-3">


        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome to the Library Management System</h1>
            <p class="lead">Manage your library collection and borrow books with ease.</p>
            <a class="btn btn-primary btn-lg" href="/login.php" role="button">Learn more</a>
        </div>
    </main>

</body>

</html>