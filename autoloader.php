<?php 
// Chargement automatique des classes
spl_autoload_register(function($className) {
    $className = str_replace('\\','/',$className);
    require './'.$className.".php";
});
