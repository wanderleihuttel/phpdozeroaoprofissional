<?php

class Anuncio {

    public function getMeusAnuncios(){
        global $pdo;
        $array = [];
        $sql = "SELECT *,
                    (SELECT anuncio_imagem.url
                    FROM anuncio_imagem
                    WHERE anuncio_imagem.id_anuncio = anuncio.id LIMIT 1
                    ) AS url
                FROM anuncio
                WHERE anuncio.id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
        }
        return $array;
    }


    public function cadastrar($id_categoria, $titulo, $descricao, $valor, $estado_conservacao){
        global $pdo;
        $sql = "INSERT INTO anuncio (id_usuario, id_categoria, titulo, descricao, valor, estado_conservacao) VALUES
                (:id_usuario, :id_categoria, :titulo, :descricao, :valor, :estado_conservacao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_usuario', $_SESSION['cLogin']);
        $stmt->bindValue(':id_categoria', $id_categoria);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':estado_conservacao', $estado_conservacao);
        $stmt->execute();
        if( $stmt->rowCount() > 0 ){
            return true;
        } else {
            return false;
        }

    }
}