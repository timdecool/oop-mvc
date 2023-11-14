<?php
namespace App\Models;
use App\Models\ModelTemplate;

class User extends ModelTemplate {
    public function getAll() {
        $users = [];
        $users = $this->db->query("SELECT * FROM users ORDER BY id DESC",[],"all");
        return $users;       
    }

    public function getUser($id) {
        $user = [];
        $user = $this->db->query("SELECT * FROM users WHERE id=?",[$id],"row");
        return $user;        
    }

    public function getUserByMail($mail) {
        $user = [];
        $user = $this->db->query("SELECT * FROM users WHERE mail=?",[$mail],"row");
        return $user;
    }

    public function addUser($firstName, $lastName, $mail, $password) {
        $this->db->query("INSERT INTO users SET first_name = ?, last_name = ?, mail = ?, password = ?",[$firstName, $lastName, $mail, $password]);
    }

    public function updateUser($firstName, $lastName, $mail, $id) {
        $this->db->query("UPDATE users SET first_name = ?, last_name = ?, mail = ?, date_updated = ? WHERE id=?",[$firstName, $lastName, $mail, date('Y-m-d H:i:s'), $id]);
    }

    public function updateRole($role, $id) {
        $this->db->query("UPDATE users SET role=?,date_updated=? WHERE id=?",[$role,date('Y-m-d H:i:s'),$id]);
    }

    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE id=?",[$id]);
    }
}