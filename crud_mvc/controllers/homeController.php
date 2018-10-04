<?php

class homeController extends Controller {

    public function index(){

        $dados['result'] = [
            'nome'       => 'PHP MVC',
            'idade'      => 36
        ];
        $this->loadTemplate('home', $dados);

    }
}