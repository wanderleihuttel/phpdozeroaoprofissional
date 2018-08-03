<?php 

function listar($id,$limite){
    global $pdo;
    $lista = array();
    
    $sql = "select * from usuarios where id_pai = :id";
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
        echo "<li>"  . $usuario['nome'] . "</li>";
        if(count($usuario['filhos']) > 0 ){
            exibir($usuario['filhos']);
        }
    }
    echo "</ul>";
}