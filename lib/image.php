<?php

namespace lib;

use Exception;

class Image
{

    static function store($path, $image)
    {

        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        $imageName = time() . '.' . $extension;

        $imagePath =  $path . $imageName;

        // Move the uploaded file to the new location
        if (!move_uploaded_file($image["tmp_name"], $imagePath)) {
            throw new Exception("Failed to save image");
        }

        return $imageName;
    }

    static function remove($path)
    {
        if (!file_exists($path)) return false;

        return unlink($path);
    }
}