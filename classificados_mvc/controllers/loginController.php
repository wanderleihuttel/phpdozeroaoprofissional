<?php

class loginController extends Controller {

    public function index(){
        $this->loadTemplate('login');
    }

    public function login(){
        $usuario = new Usuario();
        $dados = [];
        if( isset($_POST['email']) && (!empty($_POST['email'])) &&
            isset($_POST['senha']) && (!empty($_POST['senha'])) ){

            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if($usuario->login($email, $senha)){
                header("Location: " . BASE_URL . '/home');
            } else {
                $dados = [
                    'alert' => 'alert-warning',
                    'message' => 'Usuário e/ou senhas incorretos!'
                ];
            }
        } else {
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
        header("Location: " . BASE_URL . '/login/index');
    }

}