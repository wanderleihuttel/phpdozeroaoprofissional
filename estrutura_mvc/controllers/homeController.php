<?php

class homeController extends Controller {

    public function index(){
        $dados = [
            'quantidade' => 5,
            'nome'       => 'Wanderlei'
        ];
        $this->loadTemplate('home', $dados);

    }
}