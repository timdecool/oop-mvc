<?php
namespace App\Controllers;
use App\Models\Image;
use App\Controllers\Controller;

/**
 * 
 */

class HomeController extends Controller {
    public function index() {
        $user = new Image();
        $data = $user->getAll();
        $this->render('./views/template_gallery.phtml',$data);
    }
}