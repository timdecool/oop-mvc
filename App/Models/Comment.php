<?php
namespace App\Models;
use App\Models\AbstractManager;

class Comment extends AbstractManager {
    public function getAll() {
        $comments = [];

        $comments = $this->db->query("SELECT *, images.id AS image_id, comments.id AS comment_id, users.id AS user_id
        FROM comments 
        INNER JOIN images ON comments.id_image = images.id
        INNER JOIN users ON comments.id_user = users.id
        ORDER BY comment_id DESC",[],"all");
        return $comments;
    }

    public function getComments($id_image) {
        $comments = [];
        $comments = $this->db->query("SELECT *, comments.id AS comment_id FROM comments
        INNER JOIN users ON users.id = comments.id_user
        WHERE comments.id_image=?",[$id_image],"all");
        return $comments;
    }

    public function addComment($id_image, $id_user, $comment) {
        $this->db->query("INSERT INTO comments SET id_image = ?, id_user = ?, comment = ?",[$id_image,$id_user,$comment]);
    }

    public function deleteComment($id) {
        $this->db->query("DELETE FROM comments WHERE id=?",[$id]);
    }
}