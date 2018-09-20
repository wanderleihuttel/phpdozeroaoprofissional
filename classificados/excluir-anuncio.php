<?php
require_once('config.php');
require_once('classes/anuncio.php');

if(empty($_SESSION['cLogin'])){
    header("Location: lgin.php");
    exit;
}

if( isset($_GET['id']) && !empty($_GET['id']) ){
    $id = addslashes($_GET['id']);
    $anuncio = new Anuncio();
    if( $anuncio->excluirAnuncio($id) ){
        header("Location: meus-anuncios.php");
        exit;
    }
}
header("Location: meus-anuncios.php");