<?php

class loginController extends Controller {

    public function index(){
        $this->loadTemplate('login');
    }

    public function entrar(){
        $usuario = new Usuario();
        $dados = [];
        if( isset($_POST['email']) && (!empty($_POST['email'])) &&
            isset($_POST['senha']) && (!empty($_POST['senha'])) ){

            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if($usuario->login($email, $senha)){
                header("Location: " . BASE_URL . '/home/index');
            } else {
                $dados = [
                    'alert' => 'alert-warning',
                    'message' => 'Usuário e/ou senhas incorretos!'
                ];
            }
        } else if (!empty($_POST) ){
            $dados = [
                'alert' => 'alert-warning',
                'message' => 'Favor informar usuário e senha!'
            ];
        }
        $this->loadTemplate('login', $dados);
    }


    public function sair (){
        session_start();
        unset($_SESSION['cLogin']);
        $this->redirect('/login/index');
    } // end method sair


    public function novo() {

        print_r($_POST);

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

        } else if (!empty($_POST) ){
            $dados = [
                'alert'   => 'alert-warning',
                'message' => 'Favor preencher todos os campos!'
            ];
        }
        $this->loadTemplate('cadastro', $dados);
    } // end method novo


    public function salvar() {

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

}