<?php
namespace App\Models;
use App\Models\Model;

class Conversation extends Model {
    public function getAllByUser($id) {
        $conv = [];
        $conv = $this->db->query("SELECT * FROM conversations_users WHERE id_user=? ORDER BY last_seen DESC",[$id],"all");
        return $conv;
    }

    public function getConvUsers($id_conv) {
        $users = [];
        $users = $this->db->query("SELECT * FROM conversations_users WHERE id_conv=? ORDER BY id DESC",[$id_conv],"all");
        return $users;
    }

    public function updateLastSeen($id_user, $id_conv) {
        $this->db->query("UPDATE conversations_users SET last_seen=? WHERE id_user = ? AND id_conv = ?",[date('Y-m-d H:i:s'),$id_user,$id_conv]);
    }
}