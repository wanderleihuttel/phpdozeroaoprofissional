<?php

class Core {

    public function run(){
        $url = "/";
        if(isset($_GET['url'])){
            $url .= $_GET['url'];
        }

        $url = $this->checkRoutes($url);

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

        if( !file_exists('controllers/' . $currentController . '.php') || !method_exists($currentController, $currentAction)){
            $currentController = 'notfoundController';
            $currentAction = 'index';
        }

        $controller = new $currentController();
        call_user_func_array(array($controller, $currentAction), $params);
    }


    public function checkRoutes($url){

        global $routes;

        foreach ($routes as $pt => $new_url) {

            // Identifica os argumentos e substitui por regex
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);


            // Faz o match da URL
            if(preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1){
                array_shift($matches);
                array_shift($matches);

                // Pega todos os argumentos para associar
                $itens = array();
                if( preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $match_all) ){
                    $itens = preg_replace( '(\{|\})', '', $match_all[0] );
                }

                // Faz a associação
                $arg = array();
                foreach ($matches as $key => $match) {
                    $arg[$itens[$key]] = $match;
                }

                // Monta a nova url
                foreach ($arg as $argkey => $argvalue) {
                    $new_url = str_replace(':' . $argkey, $argvalue, $new_url);
                }

                $url = $new_url;

                break;

            }
        }
        return $url;

    } // end method checkRoutes
}