<?php 

function listar($id, $limite){
    global $pdo;
    $lista = array();
    
    $sql = "SELECT A.id, A.id_pai, A.patente, A.nome, B.nome AS p_nome
            FROM usuarios A
            LEFT JOIN patentes B ON (A.patente = B.id)
            WHERE id_pai = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    if($stmt->rowCount() > 0){
       $lista = $stmt->fetchAll();
       foreach ($lista as $chave => $usuario) {
           $lista[$chave]['filhos'] = array();
           if($limite > 0){
              $lista[$chave]['filhos'] = listar($usuario['id'],$limite-1);
            }
       }
    }
    return $lista;
}


function exibir($array){
    echo "<ul>";
    foreach ($array as $usuario) {
        echo "<li>"  . $usuario['nome'] . " (" . $usuario['p_nome'] . ")</li>";
        if(count($usuario['filhos']) > 0 ){
            exibir($usuario['filhos']);
        }
    }
    echo "</ul>";
}




function calcular_cadastros($id, $limite){
    global $pdo;
    $lista = array();
    
    $sql = "SELECT * FROM usuarios WHERE id_pai = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $filhos = 0;

    if($stmt->rowCount() > 0){
       $lista = $stmt->fetchAll();
       $filhos = $stmt->rowCount();

       foreach ($lista as $chave => $usuario) {
           if($limite > 0){
               $filhos += calcular_cadastros($usuario['id'],$limite-1);
           }
       }
    }
    return $filhos;
}