<?php

use lib\Image;
use model\BookModel;
use model\Database;

session_start();

require '../autoload.php';

$conn = Database::open();

// create book instal
$book = new BookModel($conn);

$id = $_POST['id'];

$book->find($id);

if ($book->getStatus() == 'unavailable') {
    $_SESSION['userMessage'] = "Can't Borrow Book";
} else {
    $_SESSION['userMessage'] = "Borrow Success";
    $book->setStatus('unavailable');
    $book->setBorrowedBy($_SESSION['login']);
}

// save book
$book->update();

header('location: /user.php');
