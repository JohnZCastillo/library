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

$_SESSION['myBookMessage'] = "Return Success";
$book->setStatus('available');
$book->setBorrowedBy(0);

// save book
$book->update();

header('location: /mybooks.php');
