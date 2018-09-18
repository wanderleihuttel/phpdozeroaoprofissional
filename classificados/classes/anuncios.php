<?php

class Anuncios {

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
            $array = $sql->fetchAll();
        }
        return $array;
    }
}