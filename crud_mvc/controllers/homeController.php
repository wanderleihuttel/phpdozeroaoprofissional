<?php

class homeController extends Controller {

    public function index(){
        $data = [];
        $contatos = new Contatos();
        $data['contatos'] = $contatos->getAll();
        $this->loadTemplate('home', $data);
    } // end method index

} // end class homeController