<?php

require_once './autoload.php';

use lib\Image;
use model\BookModel;
use model\Database;

//connect to databaes
$conn = Database::open();
$bookModel = new BookModel($conn);

// get all books from database
$books = $bookModel->findAll();

// handle Post Request

if (isset($_POST['newbook'])) {

    $uploadPath = "./uploads/";
    $image = $_FILES['image'];

    // create book instal
    $book = new BookModel($conn);

    $imagePath = Image::store($uploadPath, $image);
    $isbn = $_POST["isbn"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    $book->setISBN($isbn);
    $book->setTitle($title);
    $book->setDescription($description);
    $book->setImagePath($imagePath);

    // save book
    $book->save();
}

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
                        <a class="nav-link" href="signup.php">Books</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid py-2">
        <!-- <h2 class="text-center p-4">LIBRARY MANAGEMENT SYSTEM</h2> -->

        <div class="mb-2">
            <button class="btn btn-success" data-toggle="modal" data-target="#newBook">New Book</button>
            <button class="btn btn-primary">Return Book</button>
        </div>

        <table class="table table-bordered table-hover">
            <thead>

                <tr>
                    <th>Cover</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><img src=" ./uploads/<?php echo $book->getImagePath() ?>" class="image-fluid" style="max-width: 50px"></td>
                        <td><?php echo $book->getISBN() ?></td>
                        <td><?php echo $book->getTitle() ?></td>
                        <td><?php echo $book->getDescription() ?></td>
                        <td><?php echo $book->getStatus() ?></td>
                        <td>
                            <button class="btn btn-secondary">edit</button>
                            <button class="btn btn-danger">delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>


    <div class="modal" id="newBook" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="admin.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <input type="text" name="newbook" class="d-none">
                        </div>
                        <div class="form-group mb-1">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" cols="20" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>