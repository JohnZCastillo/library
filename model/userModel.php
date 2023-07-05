<?php

namespace model;

use Exception;

class UserModel extends User
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

    public function save()
    {
    }

    public function find($id)
    {

        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT * FROM user where id = ?");

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
    }

    public function findEmail($email)
    {

        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT * FROM user where email = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("s", $email);

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
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function findAll()
    {
    }

    public function login($email, $password)
    {
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT * FROM user where email = ? and password = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("ss", $email, $password);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        // throw an exception data is null that means username is not present in db
        if ($data == null) {
            return null;
        }

        $this->updateSelf($data);

        return $this;
    }

    private function updateSelf($data)
    {
        parent::setId($data['id']);
        parent::setName($data['name']);
        parent::setEmail($data['email']);
        parent::setPassword($data['password']);
        parent::setRole($data['role']);
    }
}
