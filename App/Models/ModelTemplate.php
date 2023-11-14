<?php
namespace App\Models;
use App\Services\Database;

class ModelTemplate {
    protected $db;

    protected function __construct() {
        $this->db = new Database();
    }
}