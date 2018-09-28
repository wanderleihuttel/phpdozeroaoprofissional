<?php

class produtoController extends Controller {

    public function index(){
        echo "Index Produto";
    }

    public function abrir($id){
        $dados = [];
        $anuncio = new Anuncio();

        if( empty($id) ){
            header("Location: " . BASE_URL);
        }
        $info  = $anuncio->getAnuncioById($id);

        if (empty($info)){
            header("Location: " . BASE_URL);
        }

        $dados  = [
            'info' => $info
        ];

        $this->loadTemplate('produto', $dados);
    }
}