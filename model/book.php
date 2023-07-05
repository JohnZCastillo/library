<?php

namespace model;

class Book
{
    private $id;
    private $isbn;
    private $title;
    private $description;
    private $status = "available";
    private $image_path;

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getImagePath()
    {
        return $this->image_path;
    }

    // Setter methods
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setISBN($isbn)
    {
        $this->isbn = $isbn;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }
}
