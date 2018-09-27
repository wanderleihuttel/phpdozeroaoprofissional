<?php

class Core {
    public function run(){
        $url = "/";
        if(isset($_GET['url'])){
            $url .= $_GET['url'];
        }

        $params = array();
        if( !empty($_GET['url']) && $url != "/" ){
            $url = explode('/', $url);
            array_shift($url);
            $currentController = $url[0].'Controller';
            array_shift($url);

            if( isset($url[0]) && !empty($url[0])){
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if(count($url)){
                $params = $url;
            }

        } else {
            $currentController = 'homeController';
            $currentAction     = 'index';
        }

        $controller = new $currentController();
        call_user_func_array(array($controller, $currentAction), $params);

        /*
        echo "<pre>";
        echo "CONTROLLER: " . $currentController . "\n";
        echo "ACTION:     " . $currentAction . "\n";
        echo "PARAMS:\n" ; print_r($params) ;
        */
    }
}