<?php
namespace App\Services;
use App\Models\UserManager;

class Auth {
    public function __construct() {
        session_start();
    }

    public function login() {
        $user = [];

        $manager = new UserManager();
            $user = $manager->getUserByMail($_POST['mail']);
            if(password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            }
    }

    public function logout() {
        session_unset();
        header('Location:?page=home');
    }

    public function isLogged() {
        $isLogged = false;
        if(isset($_SESSION['user'])) {
            $isLogged = true;
        }
        
        return $isLogged;
    }

}