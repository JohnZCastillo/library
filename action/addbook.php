<?php

use lib\Image;
use model\BookModel;
use model\Database;

require '../autoload.php';

$conn = Database::open();

$uploadPath = "../uploads/";
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

header('location: /admin.php');
