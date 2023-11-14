<?php
namespace App\Models;
use App\Models\ModelTemplate;

class Like extends ModelTemplate {

    public function countLikes($id_image) {
        $count = 0;
        $count = $this->db->query("SELECT COUNT(*) AS count FROM likes WHERE id_image=?",[$id_image],"col");
        return $count;   
    }

    public function hasLiked($id_user,$id_image) {
        $hasLiked = 0;
        $hasLiked = $this->db->query("SELECT COUNT(*) AS hasLiked FROM likes WHERE id_user=? AND id_image=?",[$id_user,$id_image],"col");
        return $hasLiked;
    }

    public function like($id_user,$id_image) {
        $this->db->query("INSERT INTO likes(id_user,id_image) VALUES (?,?)",[$id_user,$id_image]);
    }

    public function unlike($id_user,$id_image) {
        $this->db->query("DELETE FROM likes WHERE id_user=? AND id_image=?",[$id_user,$id_image]);
    }
}