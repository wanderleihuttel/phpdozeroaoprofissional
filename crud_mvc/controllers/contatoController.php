<?php

class contatoController extends Controller {

    public function index() {
        // do something
    } // end method index



    public function add(){
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
            $this->loadTemplate('contato-add', $data);
            exit;
        }

        $this->loadTemplate('contato-add', $data);
    } // end method add



    public function edit($id){
        $data = [];

        if( !empty($id)){
            $contatos = new Contatos();

            if( !empty($_POST['nome']) && !empty($_POST['email']) ){
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                if( $contatos->edit($id, $nome, $email) ){
                    $this->redirect('/home/index');
                    exit;
                }
            } else {
                $data['contato'] = $contatos->getById($id);
                if(isset($data['contato']['id'])){
                    $this->loadTemplate('contato-edit', $data);
                    exit;
                }
            }
        }

        $this->redirect('/home/index');
    } // end method edit



    public function delete($id){

        if(!empty($id)){
            $contatos = new Contatos();
            if( $contatos->delete($id) ){
                $this->redirect('/home/index');
            }
        }
        $this->redirect('/home/index');

    } // end method delete


} // end class contatoController
