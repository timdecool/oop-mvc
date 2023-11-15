<?php
namespace App\Models;
use App\Services\Database;

abstract class Model {
    protected $db;
    
    public function __construct() {
        $this->db = new Database();
    }
}