<?php

require_once './autoload.php';

use lib\Authentication;
use model\BookModel;
use model\Database;

Authentication::authorizeOnly();


//connect to databaes
$conn = Database::open();
$bookModel = new BookModel($conn);

// get all books from database
$id =  $_SESSION['login'];
$books = $bookModel->borrowed($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inlcude header -->
    <?php include './partials/header.php'; ?>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top px-3">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-poo">GROUP 3</I>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#zzzz">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="zzzz">
            <ul class="navbar-nav">
            <li class="nav-item active">
                    <a class="nav-link" href="./user.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./mybooks.php">My Books</a>
                </li>
                <li class="nav-item bg-danger rounded">
                    <a class="nav-link text-white" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="p-3">
        <h3 class="header mt-2">My Borrowed Books</h3>
        <div class="container-fluid p-3 row">


            <?php foreach ($books as $book) : ?>

                <div class="card col-sm com-md-4 col-xl-3" style="max-width: 200px">
                    <img class="card-img-top" style="max-width:200px;" src="./uploads/<?php echo $book->getImagePath() ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book->getTitle() ?></h5>
                        <p class="card-text"><?php echo $book->getImagePath() ?></p>
                        <p class="card-text">Status: <?php echo $book->getStatus() ?></p>

                        <div>
                            <form action="./action/returnbook.php" method="POST">
                                <input type="text" value="<?php echo $book->getId() ?>" name="id" class="d-none">
                                <button type="submit" class="btn btn-primary">Return</button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>


            <div class="modal" id="myBookMessage" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p> <?php echo ($_SESSION['myBookMessage']) ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['myBookMessage'])) : ?>
        <script>
            $('#myBookMessage').modal('show')
        </script>

        <?php unset($_SESSION['myBookMessage']) ?>
    <?php endif; ?>


</body>

</html>