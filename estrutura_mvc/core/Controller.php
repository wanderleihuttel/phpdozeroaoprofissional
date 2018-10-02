<?php

class Controller {

    public function loadView( $viewName, $viewData = [] ){
        extract($viewData);
        require 'views' . DS . $viewName . '.php';
    }

    public function loadTemplate( $viewName, $viewData = [] ){
        require 'views' . DS . 'template.php';
    }

    public function loadViewInTemplate( $viewName, $viewData = array() ){
        extract($viewData);
        require 'views' . DS . $viewName . '.php';
    }

    public function redirect( $route = '' ){
        header("Location: " . BASE_URL . $route);
    }
}