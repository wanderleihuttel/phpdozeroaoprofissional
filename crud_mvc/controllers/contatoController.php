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
            $data = [
                'modal_title' => 'Adicionar contato',
                'action'      => BASE_URL . "/contato/add",
            ];
            $this->loadView('contato-add', $data);
            exit;        }

    } // end method add


    public function edit($id){
        $data = [];
        $contatos = new Contatos();

        // Se o id for vazio redireciona para o /home/index
        if(empty($id)){
           $this->redirect('/home/index');
           //exit;
        } else { // Entra no else se o id não for vazio

            // Se não existir a varável confirm-delete como post,
            // exibe mensagem para confirmar a exclusão
            if( isset($_POST['confirm-edit']) && !empty($_POST['confirm-edit']) ){

                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                if( $contatos->edit($id, $nome, $email) ){
                    $this->redirect('/home/index');
                    exit;
                }
            } else {
                $contato = $contatos->getById($id);
                $data['contato'] = $contatos->getById($id);
                $data = [
                    'modal_title' => 'Editar contato',
                    //'modal_body'  => "Você tem certeza que deseja excluir o contato {$contato['nome']} ?",
                    'action'      => BASE_URL . "/contato/edit/{$id}",
                    'contato'     =>  $data['contato']
                ];
                $this->loadView('contato-edit', $data);
                exit;
            }
        }
    } // end method edit


    public function delete($id){

        $data = [];
        $contatos = new Contatos();
        // Se o id for vazio redireciona para o /home/index
        if(empty($id)){
           $this->redirect('/home/index');
           exit;
        } else { // Entra no else se o id não for vazio

            // Se não existir a varável confirm-delete como post,
            // exibe mensagem para confirmar a exclusão
            if( isset($_POST['confirm-delete']) && !empty($_POST['confirm-delete']) ){
                $contatos = new Contatos();
                if( $contatos->delete($id) ){
                    $this->redirect('/home/index');
                    exit;
                }
            } else {
                $contato = $contatos->getById($id);
                $data = [
                    'modal_title' => 'Excluir Contato',
                    'modal_body'  => "Você tem certeza que deseja excluir o contato {$contato['nome']} ?",
                    'action'      => BASE_URL . "/contato/delete/{$id}"
                ];
                $this->loadView('contato-delete', $data);
                exit;
            }
        }

    } // end method delete


} // end class contatoController
