<?php

class homeController extends Controller {

    public function index(){

        if(empty($_SESSION['cLogin'])){
            header("Location: " . BASE_URL . '/login');
            exit;
        }

        $dados = [];

        $anuncio = new Anuncio();
        $usuario = new Usuario();
        $categoria = new Categoria();


        $maior_preco = ceil($anuncio->getMaxPreco());

        $filtro = [
             'categoria' => '',
             'valor_minimo' => '0',
             'valor_maximo' => $maior_preco,
             'estado_conservacao' => ''
        ];
        if( isset($_GET['filtro']) ){
            $filtro = $_GET['filtro'];
        }

        $total_anuncios = $anuncio->getTotalAnuncios($filtro);
        $total_usuarios = $usuario->getTotalUsuarios();

        $p = 1;

        if( isset($_GET['p']) && !empty($_GET['p']) ){
            $p = addslashes($_GET['p']);
        }
        $item_por_pagina = 2;
        $total_paginas = ceil($total_anuncios/$item_por_pagina);

        $anuncios = $anuncio->getUltimosAnuncios($p, $item_por_pagina, $filtro);
        $categorias = $categoria->getCategorias();

        $dados = [
            'total_anuncios' => $total_anuncios,
            'total_usuarios' => $total_usuarios,
            'total_paginas'  => $total_paginas,
            'categorias'     => $categorias,
            'anuncios'       => $anuncios,
            'filtro'         => $filtro,
            'maior_preco'    => $maior_preco,
            'p'              => $p
        ];


        $this->loadTemplate('home', $dados);

    }
}