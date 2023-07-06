 <?php

    use lib\Image;
    use model\BookModel;
    use model\Database;

    require_once '../autoload.php';

    $id = $_POST['deleteId'];

    $uploadPath = "../uploads/";

    $conn = Database::open();

    // create book instal
    $book = new BookModel($conn);

    $book->find($id);

    $image = $book->getImagePath();

    $book->delete();

    Image::remove($uploadPath . $image);

    header('location: ../admin.php');