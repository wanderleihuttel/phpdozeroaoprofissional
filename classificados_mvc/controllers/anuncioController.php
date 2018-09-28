<?php

class anuncioController extends Controller {
    public function index(){
        $dados = [];
        $anuncio = new Anuncio();
        $anuncios = $anuncio->getMeusAnuncios();
        $dados = [
            'anuncios' => $anuncios
        ];
        $this->loadTemplate('anuncios', $dados);
    }
}