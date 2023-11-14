<?php 
namespace App\Services;

/**
 * Simple class to get the page to insert in the general layout based on $_GET['page']
 **/

class Router {
    // Properties
    private $page;

    // Constructor
    public function __construct() {
        $this->setPage();
        // On appelle un accesseur, une méthode qui définit la page;
    }

    // Methods
    public function setPage() {
        $this->page = isset($_GET['page']) && file_exists('./App/Controllers/'.ucfirst($_GET['page']).'Controller.php') ? strtolower($_GET['page']):'home';
    }
    
    public function getPage() {
        return $this->page;
    }
}