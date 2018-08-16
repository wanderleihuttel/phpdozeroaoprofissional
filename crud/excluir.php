<?php
require_once("contato.php");
$contato = new Contato();

if(!empty($_GET['id'])){
    $id = addslashes($_GET['id']);
    if( $contato->excluir($id) ){
        header("Location: index.php");    
    } else {
        echo "Ocorreu algum erro durante a exclusão!";
        exit;
    }
}
header("Location: index.php");
