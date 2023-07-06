<?php

require_once './autoload.php';

use lib\Authentication;
use model\BookModel;
use model\Database;
use model\UserModel;

Authentication::authorizeOnly();

//connect to databaes
$conn = Database::open();
$bookModel = new BookModel($conn);
$userModel = new UserModel($conn);

$users = $userModel->findAll();
$books = $bookModel->findAll();

$borrowedBooks = [];

foreach ($users as $user) {

    $id = $user->getId();
    $books = $bookModel->borrowed($id);

    foreach ($books as $book) {

        $temp['book'] = $book;
        $temp['user'] = $user;

        $borrowedBooks[] = $temp;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './partials/header.php'; ?>
</head>

<body>


    <div>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top px-3">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-poo">Admin</I>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#zzzz">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="zzzz">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="borrowers.php">Borrowed Books</a>
                    </li>
                    <li class="nav-item bg-danger rounded">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <main class="container-fluid py-2">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <td>Title</td>
                <td>Borrower Name</td>
                <td>Borrower Email</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowedBooks as $borrowedBook) : ?>
                <tr>
                    <td> <?php echo $borrowedBook['book']->getTitle(); ?></td>
                    <td> <?php echo $borrowedBook['user']->getName(); ?></td>
                    <td> <?php echo $borrowedBook['user']->getEmail(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </main>
   
</body>

</html>