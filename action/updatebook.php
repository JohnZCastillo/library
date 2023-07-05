<?php

use lib\Image;
use model\BookModel;
use model\Database;

require '../autoload.php';

$conn = Database::open();

// create book instal
$book = new BookModel($conn);

$id = $_POST['id'];

$book->find($id);

$isbn = $_POST["isbn"];
$title = $_POST["title"];
$description = $_POST["description"];
$status = $_POST["status"];

$book->setISBN($isbn);
$book->setTitle($title);
$book->setDescription($description);
$book->setStatus($status);

if($book->getStatus() == 'available'){
    $book->setBorrowedBy(0);
}

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadPath = "../uploads/";
    $image = $_FILES['image'];
    $imagePath = Image::store($uploadPath, $image);
    $book->setImagePath($imagePath);
}

// save book
$book->update();

header('location: /admin.php');
