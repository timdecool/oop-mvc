<?php
namespace App\Controllers;
use App\Models\User;
use App\Controllers\ControllerTemplate;

/**
 * 
 */

class HomeController extends ControllerTemplate {
    public function index(){
        $user = new User;
        $data = $user->getAll();
        $this->render('./views/template_home.phtml',$data);
    }
}