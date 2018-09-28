<?php

class homeController extends Controller {

    public function index(){
        $anuncio = new Anuncios();
        $usuario = new Usuarios();

        $dados['result'] = [
            'quantidade' => $anuncio->getQuantidade(),
            'nome'       => $usuario->getNome(),
            'idade'      => $usuario->getIdade()
        ];
        $this->loadTemplate('home', $dados);

    }
}