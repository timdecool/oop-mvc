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
            $fileName =  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/','-',$_POST['title'])));
            
            if(!empty($_FILES['image_file']['tmp_name'])) {
                // On récupère notre fichier temporaire
                $tempFile = $_FILES['image_file']['tmp_name'];
                // On peut récupérer des infos sur le fichier uploadé
                $isValid = true;

                $checkFile = getimagesize($tempFile);
                if($checkFile) $ext = explode("/",$checkFile['mime']);
                if(!$checkFile || ($ext[1] != "jpeg" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "webp")) {
                    $errors[] = "Format de fichier invalide.";
                    $isValid = false;
                }

                if($_FILES['image_file']['size'] > ini_get('upload_max_filesize')) {
                    $errors[] = "Fichier trop volumineux.";
                    $isValid = false;
                }

                if($isValid) {
                    // On précise le nom du fichier, en l'occurrence, l'id user et un timestamp
                    $newFile = './uploads/'.time().'-'.$fileName.'.'.$ext[1];
                    // On copie le fichier temporaire vers un vrai fichier dans le dossier uploads
                    move_uploaded_file($tempFile,$newFile);
                    $image->setSrc($newFile);
                }
            } else {
                $image->setSrc(trim(strip_tags($_POST['src'])));
            }
            $image->clean($_POST);
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
            $image->clean($_POST);
            $errors = $image->validate();

            if(empty($errors)) {
                $info = $image->toArray();
                $info[] = date('Y-m-d H:i:s');
                $info[] = $image->getId();
                $manager->update($info);
                header('Location:?page=image');
            }
        }
        $imageData = $manager->get($_GET['id']);
        $this->render('./views/template_editimage.phtml',['img' => $imageData, 'errors' => $errors]);
    }

    // DELETE
    public function delete() {
        $manager = new ImageManager();
        $i = $manager->get($_GET['id']);
        unlink($i['src']);
        $manager->delete($_GET['id']);
        header('Location:?page=image');
    }
}