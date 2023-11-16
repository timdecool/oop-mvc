<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\UserManager;

class UserController extends Controller {
    public function index() {
        $user = new User();
        $errors = [];
        if (isset($_POST['newUser'])) {
            $user->setFirstName(strip_tags($_POST['firstName']));
            $user->setLastName(strip_tags($_POST['lastName']));
            $user->setMail(strip_tags($_POST['mail']));
            $user->setPassword(strip_tags($_POST['password']));

            $errors = $user->validate();
            if(empty($errors)) {
                $manager = new UserManager();
                $manager->insert($user->toArray());
            }

        }
        $this->render('./views/template_user.phtml',[
            'user' => $user,
            'errors' => $errors
        ]);
    }

}
