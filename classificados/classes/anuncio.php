<?php

class Anuncio {

    public function getAnuncioById($id) {
        global $pdo;
        $array = [];
        $sql = "SELECT * FROM anuncio WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetch();
        }
        return $array;
    }

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


    public function adicionarAnuncio($id_categoria, $titulo, $descricao, $valor, $estado_conservacao){
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

    public function editarAnuncio($id, $id_categoria, $titulo, $descricao, $valor, $estado_conservacao){
        global $pdo;
        $sql = "UPDATE anuncio SET
                id_categoria = :id_categoria,
                titulo = :titulo,
                descricao= :descricao,
                valor = :valor,
                estado_conservacao = :estado_conservacao
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        //$stmt->bindValue(':id_usuario', $_SESSION['cLogin']);
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


    public function excluirAnuncio($id){
        global $pdo;
        $sql1 = "DELETE FROM anuncio_imagem WHERE id_anuncio = :id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindValue(":id", $id);
        $stmt1->execute();

        $sql2 = "DELETE FROM anuncio WHERE id = :id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindValue(":id", $id);
        $stmt2->execute();

        if( $stmt1->rowCount() > 0 && $stmt2->rowCount() > 0 ){
            return true;
        } else {
            return false;
        }
    }

}