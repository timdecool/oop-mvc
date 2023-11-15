<?php
namespace App\Controllers;
use App\Models\UserManager;
use App\Controllers\Controller;

/**
 * 
 */

class HomeController extends Controller {
    public function index() {
        $user = new UserManager();
        $data = $user->getAll();
        $this->render('./views/template_home.phtml',$data);
    }
}