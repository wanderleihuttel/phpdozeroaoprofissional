<?php

class anuncioController extends Controller {

    public function index(){
        $dados = [];
        $anuncio = new Anuncio();
        $anuncios = $anuncio->getMeusAnuncios();
        $dados = [
            'anuncios' => $anuncios
        ];
        $this->loadTemplate('anuncio', $dados);
    } // end method index


    public function novo(){

        $dados = [];
        if( isset($_POST['id_categoria']) && (!empty($_POST['id_categoria'])) &&
            isset($_POST['titulo']) && (!empty($_POST['titulo'])) &&
            isset($_POST['descricao']) && (!empty($_POST['descricao'])) &&
            isset($_POST['valor']) && (!empty($_POST['valor'])) &&
            isset($_POST['estado_conservacao']) ){

            $id_categoria = addslashes($_POST['id_categoria']);
            $titulo = addslashes($_POST['titulo']);
            $descricao = addslashes($_POST['descricao']);
            $valor = str_replace(",", ".", str_replace(".","",addslashes($_POST['valor'])));
            $estado_conservacao = addslashes($_POST['estado_conservacao']);


            $anuncio = new Anuncio();
            if($anuncio->adicionarAnuncio($id_categoria, $titulo, $descricao, $valor, $estado_conservacao)){
                $dados = [
                    'alert'    => 'alert-success',
                    'message' => 'Anúncio cadastrado com sucesso!'
                ];
            } else {
                $dados = [
                    'alert'    => 'alert-danger',
                    'message' => 'Ocorreu um erro ao salvar o registro'
                ];
            }

        } else if(isset($_POST['submit'])){
            $dados = [
                'alert'   => 'alert-warning',
                'message' => 'Favor preencher todos os campos!'
            ];
        }
        $this->loadTemplate('novo-anuncio', $dados);

    } // end method novo


    public function editar($id){

        if( empty($id) ){
            header("Location: " . BASE_URL . '/anuncio/index');
        }
        $dados = [];
        $fotos = [];
        $anuncio = new Anuncio();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        $info = $anuncio->getAnuncioById($id);
        $dados = [
            'id'       => $id,
            'anuncio'  => $anuncio,
            'fotos'    => $fotos,
            'categorias' => $categorias,
            'alert'    => 'alert-success',
            'message'  => 'Anúncio editado com sucesso!',
            'info'     => $info
        ];
        $this->loadTemplate('editar-anuncio', $dados);
    } // end method editar


    public function salvar(){

        $dados = [];
        if( isset($_POST['id_categoria']) && (!empty($_POST['id_categoria'])) &&
            isset($_POST['titulo']) && (!empty($_POST['titulo'])) &&
            isset($_POST['descricao']) && (!empty($_POST['descricao'])) &&
            isset($_POST['valor']) && (!empty($_POST['valor'])) &&
            isset($_POST['estado_conservacao']) && (!empty($_POST['estado_conservacao'])) &&
            isset($_POST['id']) && (!empty($_POST['id'])) ){

            $id_categoria = addslashes($_POST['id_categoria']);
            $titulo = addslashes($_POST['titulo']);
            $descricao = addslashes($_POST['descricao']);
            $valor = str_replace(",", ".", str_replace(".","",addslashes($_POST['valor'])));
            $estado_conservacao = addslashes($_POST['estado_conservacao']);
            $id = addslashes($_POST['id']);

            if( isset($_FILES['fotos']) ){
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = [];
            }

            $anuncio = new Anuncio();
            if($anuncio->editarAnuncio($id, $id_categoria, $titulo, $descricao, $valor, $estado_conservacao, $fotos)){
                $dados = [
                    'alert'    => 'alert-warning',
                    'message' => 'Anúncio editado com sucesso!'
                ];
                header("Location: " . BASE_URL . "/anuncio/editar/{$id}");
            } else {
                $dados = [
                    'alert'    => 'alert-danger',
                    'message' => 'Ocorreu um erro ao salvar o anúncio'
                ];
            }

        } else {
            $dados = [
                'alert'   => 'alert-warning',
                'message' => 'Favor preencher todos os campos!'
            ];
        }
        $this->redirect('/anuncio/index');
    } // end method salvar


} // end class anuncioController