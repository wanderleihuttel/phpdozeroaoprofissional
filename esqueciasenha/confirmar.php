<?php 
require_once 'config.php';
if( !empty($_GET['h']) ){
    $h = addslashes($_GET['h']);
    $sql = "UPDATE usuarios SET status = 1 WHERE  md5(id) = :id_md5";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_md5', $h);
    $stmt->execute();

    if ( $stmt->rowCount() ){
        echo "Cadastro efetuado com sucesso!";
    } else {
        echo "Ocorreu um erro durante a ativação do seu cadastro";
    }
}