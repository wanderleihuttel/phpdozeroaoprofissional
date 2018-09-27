<?php

class galeriaController extends Controller{
    public function index(){
        $dados = [
            'quantidade' => 129
        ];
        $this->loadTemplate('galeria', $dados);
    }
}