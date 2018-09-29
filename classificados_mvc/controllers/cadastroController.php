<?php

class cadastroController extends Controller {

    public function index(){
        $this->loadTemplate('cadastro');
    } // end method index


    public function novo() {

        $usuario = new Usuario();
        $dados = [];
        if( isset($_POST['nome']) && (!empty($_POST['nome'])) &&
            isset($_POST['email']) && (!empty($_POST['email'])) &&
            isset($_POST['telefone']) && (!empty($_POST['telefone'])) &&
            isset($_POST['senha']) && (!empty($_POST['senha'])) ){

            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $telefone = addslashes($_POST['telefone']);
            $senha = addslashes($_POST['senha']);

            if($usuario->cadastrar($nome, $email, $telefone, $senha)){
                $dados = [
                    'alert'    => 'alert-success',
                    'message' => 'Usuário cadastrado com sucesso! <a href="' . BASE_URL . '/login" class="alert-link">Efetue o login</a>'
                ];
            } else {
                $dados = [
                    'alert'    => 'alert-warning',
                    'message' => 'Este usuário já existe!'
                ];
            }

        } else {
            $dados = [
                'alert'   => 'alert-warning',
                'message' => 'Favor preencher todos os campos!'
            ];
        }
        $this->loadTemplate('cadastro', $dados);
    } // end method novo
} // end class cadastroController