<?php
namespace App\Controllers;

class ControllerTemplate {
    protected function render($templatePath,$data) {
        ob_start();
        include $templatePath;
        $content = ob_get_clean();
        include './views/layout.phtml';
    }
}