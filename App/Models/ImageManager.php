<?php
namespace App\Models;
use App\Models\AbstractManager;


class ImageManager extends AbstractManager {
    /////////////////////
    ////// SELECTS //////
    /////////////////////

    public function getAll(): array {
        $images = [];
        $images = $this->db->query("SELECT * FROM images ORDER BY id DESC",[],"all");
        return $images;        
    }

    public function countAll(): int {
        $count = 0;
        $count = $this->db->query("SELECT COUNT(*) AS count FROM images",[],"col");
        return $count;        
    }

    public function getAllByUser($id) {
        $images = [];
        $images = $this->db->query("SELECT * FROM images WHERE id_user=? ORDER BY id DESC",[$id],"all");
        return $images;
    }

    public function getOnePage($offset,$limit) {
        $images = [];
        $images = $this->db->limitedQuery("SELECT * FROM images ORDER BY id DESC LIMIT :offset,:limit",$offset,$limit);
        return $images;
    }

    public function get($id) {
        $image = [];
        $image = $this->db->query("SELECT * FROM images WHERE id=?",[$id],"row");
        return $image;
    }

    public function getLastImages() {
        $images = [];
        $images = $this->db->query("SELECT * FROM images ORDER BY id DESC limit 3",[],"all");
        return $images;
    }

    public function getImagesByQuery($query) {
        $images = [];
        $images = $this->db->query("SELECT * FROM images WHERE author LIKE ? OR title LIKE ? OR description LIKE ? OR id LIKE ?",["%".$query."%","%".$query."%","%".$query."%","%".$query."%"],"all");
        return $images;
    }

    //////////////////
    /////// CUD //////
    //////////////////

    public function insert(?array $info) {
        $this->db->query("INSERT INTO images (src, title, author, author_link, description) VALUES (?, ?, ?, ?, ?)",
        $info);
    }

    public function update(?array $info) {
        $this->db->query("UPDATE images SET src=?, title=?, author=?, author_link=?, description=?, date_updated=? WHERE id = ?",
        $info);
    }

    public function delete($id) {
        $this->db->query("DELETE FROM images WHERE id=?",[$id]);
    }
}