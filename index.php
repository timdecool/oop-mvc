<?php
namespace App;

// Imports nécessaires
use App\Services\Router;
require_once './autoloader.php';

// Détermination de la route ?page
$router = new Router();
$page = $router->getPage();

// Chargement du contrôleur correspondant
$controllerName = 'App\Controllers\\'.ucfirst($page).'Controller';
// require_once './classes/Controllers/'. $controllerName . '.php';
$controller = new $controllerName();

$controller->index();
