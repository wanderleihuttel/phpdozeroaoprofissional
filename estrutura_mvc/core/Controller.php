<?php

class Controller {

    public function loadView($viewName, $viewData = [] ){
        extract($viewData);
        require 'views' . DS . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = []){
        require 'views' . DS . 'template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = []){
        extract($viewData);
        require 'views' . DS . $viewName . '.php';
    }

}