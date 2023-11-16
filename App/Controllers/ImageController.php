<?php
namespace App\Controllers;
use App\Models\ImageManager;
use App\Models\Image;
use App\Controllers\Controller;

/**
 * 
 */

class ImageController extends Controller {
    // READ
    public function index() {
        $getImages = new ImageManager();
        $gallery = $getImages->getAll();
        $this->render('./views/template_gallery.phtml',['gallery' => $gallery]);
    }    

    // CREATE
    public function add() {
        $errors = [];
        $image = new Image();
        if(isset($_POST['newImage'])) {
            $image->setSrc(trim(strip_tags($_POST['src'])));
            $image->setTitle(trim(strip_tags($_POST['title'])));
            $image->setAuthor(trim(strip_tags($_POST['author'])));
            $image->setAuthorLink(trim(strip_tags($_POST['author-link'])));
            $image->setDescription(trim(strip_tags($_POST['description'])));
            $errors = $image->validate();
            if(empty($errors)) {
                $manager = new ImageManager();
                $manager->insert($image->toArray());
            }   
        }
        $this->render('./views/template_addimage.phtml',['errors' => $errors]);
    }

    // UPDATE
    public function edit() {
        $errors = [];
        $manager = new ImageManager();
        $image = new Image();
        if(isset($_POST['editImg'])) {
            $image->setId($_GET['id']);
            $image->setSrc(trim(strip_tags($_POST['src'])));
            $image->setTitle(trim(strip_tags($_POST['title'])));
            $image->setAuthor(trim(strip_tags($_POST['author'])));
            $image->setAuthorLink(trim(strip_tags($_POST['author-link'])));
            $image->setDescription(trim(strip_tags($_POST['description'])));
            $errors = $image->validate();
            if(empty($errors)) {
                $info = $image->toArray();
                $info[] = date('Y-m-d H:i:s');
                $info[] = $image->getId();
                $manager->update($info);
            }
        }
        $imageData = $manager->get($_GET['id']);
        $this->render('./views/template_editimage.phtml',['img' => $imageData, 'errors' => $errors]);
    }

    // DELETE
    public function delete() {
        $manager = new ImageManager();
        $manager->delete($_GET['id']);
        header('Location:?page=image');
    }
}