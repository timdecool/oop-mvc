<?php
namespace App\Models;
use App\Models\Model;

class ImageUser extends Model {
    public function getImageDetails($id) {
        $image = [];
        $image = $this->db->query("SELECT images.*, users.first_name AS first_name, users.last_name AS last_name FROM images 
        INNER JOIN users ON users.id = images.id_user WHERE images.id=?",[$id],"row");
        return $image;
    }
}