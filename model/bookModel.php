<?php

namespace model;

use Exception;

class BookModel extends Book
{

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getConnection()
    {
        return $this->connection;
    }


    public function find($id)
    {

        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT * FROM book where id = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("i", $id);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        // throw an exception data is null that means username is not present in db
        if ($data == null) {
            throw new Exception('Username not found | Invalid Connection');
        }

        $this->updateSelf($data);

        return $this;
    }

    public function save()
    {

        $isbn = parent::getISBN();
        $title = parent::getTitle();
        $description = parent::getDescription();
        $status = parent::getStatus();
        $imagePath = parent::getImagePath();

        $conn = $this->getConnection();


        $stmt = $conn->prepare("INSERT INTO book (isbn, title, description, status, image_path) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $isbn, $title, $description, $status, $imagePath);

        // execute prepared statement
        $result = $stmt->execute();

        if ($result) {
            $this->setId($conn->insert_id);
            return;
        }

        throw new Exception("Error Saving Book");
    }

    public function update()
    {
        $conn = $this->getConnection();

        $isbn = parent::getISBN();
        $title = parent::getTitle();
        $description = parent::getDescription();
        $status = parent::getStatus();
        $imagePath = parent::getImagePath();
        $id = parent::getId();

        $stmt = $conn->prepare("UPDATE book SET isbn= ?, title = ?, description = ?, status = ?, image_path = ? WHERE id = ?");

        $stmt->bind_param("sssssi", $isbn, $title, $description, $status, $imagePath,$id);


        // execute prepared statement
        $result = $stmt->execute();

        if ($result) {
            $this->setId($conn->insert_id);
            return;
        }

        throw new Exception("Error Saving Book");
    }

    public function delete()
    {

        $conn = $this->getConnection();

        $stmt = $conn->prepare("DELETE FROM book WHERE id = ?");

        $id =$this->getId();

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function findAll()
    {

        $conn = $this->getConnection();

        $result = $conn->query("SELECT * FROM book");

        $books = [];

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $book = new Book();
                $book->setId($row['id']);
                $book->setISBN($row['isbn']);
                $book->setTitle($row['title']);
                $book->setDescription($row['description']);
                $book->setStatus($row['status']);
                $book->setImagePath($row['image_path']);

                $books[] = $book;
            }
        }

        return $books;
    }

    private function updateSelf($data)
    {
        parent::setId($data['id']);
        parent::setTitle($data['title']);
        parent::setDescription($data['description']);
        parent::setStatus($data['status']);
        parent::setImagePath($data['image_path']);
    }
}
