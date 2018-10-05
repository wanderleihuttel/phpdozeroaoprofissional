<?php

class contatoController extends Controller {

    public function index() {}


    public function add(){
        $data = [];
        $this->loadTemplate('contato-add', $data);
    }
    // end method add

    public function add_save(){
        $data = [];
        if( isset($_POST['nome']) && !empty($_POST['nome']) &&
            isset($_POST['email']) && !empty($_POST['email']) ){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);

            $contatos = new Contatos();
            if( $contatos->insert($nome, $email) ){
                $this->redirect('/home/index');
            }
        } else {
            $data = [
                'alert'   => 'alert-warning',
                'message' => 'Favor preencher todos os campos!'
            ];
            //$this->redirect('/contato/add', $data);
            $this->loadTemplate('contato-add', $data);
            exit;
        }

        $this->loadTemplate('contato-add', $data);
    }
    // end method index

    public function edit($id){
        $data = [];
        $contatos = new Contatos();
        $contato = $contatos->getById($id);
        $data['contato'] = $contato;
        $this->loadTemplate('contato-edit', $data);
    }
    // end method edit

    public function edit_save(){
        $data = [];
        if( isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['nome']) && !empty($_POST['nome']) &&
            isset($_POST['email']) && !empty($_POST['email']) ){
            $id = addslashes($_POST['id']);
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);

            $contatos = new Contatos();
            if( $contatos->edit($id, $nome, $email) ){
                $this->redirect('/home/index');
            }
        }

        $this->loadTemplate('contato-add', $data);
    }


} // end class contatoController
