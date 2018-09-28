<?php

class Categoria extends Model {
    public function getCategorias(){

        $array = [];
        $sql = "SELECT id, nome FROM categoria ORDER BY nome";
        $stmt = $this->db->query($sql);
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
        }
        return $array;
    }

}