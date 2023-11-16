<?php
namespace App\Models;
use App\Models\AbstractManager;

class Message extends AbstractManager {

    public function getAllUserMessages($id) {
        $messages = [];
        $messages = $this->db->query("SELECT * FROM messages 
        WHERE id_sender=? OR id_receiver=? ORDER BY id DESC",[$id,$id],"all");
        return $messages;
    }

    public function getConversation($id_conv) {
        $messages = [];
        $messages = $this->db->query("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id ASC",[$id_conv],"all");

        return $messages;
    }

    public function sendMessage($id_conv,$id_sender,$message) {
        $this->db->query("INSERT INTO messages(id_conv,id_sender,message)
        VALUES (?,?,?)",[$id_conv,$id_sender,$message]);
    }

    public function getLastMessage($id_conv) {
        $message = [];
        $message = $this->db->query("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id DESC LIMIT 1",[$id_conv],"row");
        return $message;
    }
}