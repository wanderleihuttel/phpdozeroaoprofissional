<?php

class galeriaController{
    public function index(){
        echo "Página Index Galeria";
    }

    public function abrir($id){
        if(!empty($id)){
            echo "Abrindo galeria: " . $id;
        } else {
            echo "É preciso informar uma galeria";
        }
    }
}