<?php
require_once('config.php');
require_once('classes/anuncio.php');

if(empty($_SESSION['cLogin'])){
    header("Location: login.php");
    exit;
}

if( isset($_GET['id']) && !empty($_GET['id']) ){
    $id = addslashes($_GET['id']);
    $anuncio = new Anuncio();
    $id_anuncio = $anuncio->excluirFoto($id);
    if( $id_anuncio > 0 ){
        header("Location: editar-anuncio.php?id={$id_anuncio}");
        exit;
    }
}
header("Location: meus-anuncios.php");