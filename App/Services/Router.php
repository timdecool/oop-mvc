<?php 
namespace App\Services;

/**
 * Simple class to get the page to insert in the general layout based on $_GET['page']
 **/

class Router {
    // Properties
    private $page;
    private $action;

    // Constructor
    public function __construct() {
        $this->setPage();
        $this->setAction();
    }

    // Methods
    public function setPage() {
        $this->page = isset($_GET['page']) && file_exists('./App/Controllers/'.ucfirst($_GET['page']).'Controller.php') ? strtolower($_GET['page']):'home';
    }
    
    public function getPage() {
        return $this->page;
    }

    public function setAction() {
        $this->action = isset($_GET['method']) ? strtolower($_GET['method']):'index';
    }

    public function getAction() {
        return $this->action;
    }

    public function run() {
        // Détermination de la route ?page
        $page = $this->getPage();
        $action = $this->getAction();
        $controllerName = 'App\Controllers\\'.ucfirst($page).'Controller';
        $controller = new $controllerName();
        $controller->$action();
    }
}