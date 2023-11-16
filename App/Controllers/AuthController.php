<?php

namespace App\Controllers;
use App\Models\UserManager;
use App\Controllers\Controller;

/**
 * 
 */

class AuthController extends Controller {
    public function index() {
        $user = new UserManager();
        $data = $user->getAll();
        $this->render('./views/template_home.phtml',$data);
    }

    public function login() {
        $user = [];
        $hey = "";
        if(isset($_POST['login'])) {
            $manager = new UserManager();
            $user = $manager->getUserByMail($_POST['mail']);
            
            if(password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                $hey = "hey !";
            }
        }

        $this->render('./views/template_login.phtml',[
            'user' => $user,
            'hey' => $hey
        ]);
    }

    public function logout() {
        session_unset();
        header('Location:?page=home');
    }
}