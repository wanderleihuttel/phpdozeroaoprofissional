<?php

class homeController extends Controller {

    public function index(){

        $dados = [];
        $fotos = new Fotos();

        $fotos->saveFotos();

        $dados['fotos'] = $fotos->getFotos();

        $this->loadTemplate('home', $dados);

    }
}