<?php

class Categoria {

    public function getCategorias(){
        global $pdo;
        $array = [];
        $sql = "SELECT id, nome FROM categoria ORDER BY nome";
        $stmt = $pdo->query($sql);
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
        }
        return $array;
    }

}