<?php

class Anuncio {

    public function getTotalAnuncios(){
        global $pdo;
        $sql = "SELECT count(*) AS total FROM anuncio";
        $stmt = $pdo->query($sql);
        if( $stmt->rowCount() > 0 ){
            $row = $stmt->fetch();
            return $row['total'];
        }
    }


    public function getAnuncioById($id) {
        global $pdo;
        $array = [];
        $sql = "SELECT *,
                (SELECT categoria.nome
                    FROM categoria
                    WHERE categoria.id = anuncio.id_categoria
                ) AS categoria,
                (SELECT usuario.telefone
                    FROM usuario
                    WHERE usuario.id = anuncio.id_usuario
                ) AS telefone
        FROM anuncio WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetch();
            $array['fotos'] = [];
            $sql = "SELECT id, url FROM anuncio_imagem WHERE id_anuncio = :id_anuncio";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id_anuncio",$id);
            $stmt->execute();
            if( $stmt->rowCount() > 0){
                $array['fotos'] = $stmt->fetchAll();
            }
        }
        return $array;
    }

    public function getUltimosAnuncios($pagina_atual, $item_por_pagina){
        global $pdo;

        $offset = ($pagina_atual -1) * $item_por_pagina;
        $rows = $item_por_pagina;

        $array = [];
        $sql = "SELECT *,
                    (SELECT anuncio_imagem.url
                    FROM anuncio_imagem
                    WHERE anuncio_imagem.id_anuncio = anuncio.id LIMIT 1
                    ) AS url,
                    (SELECT categoria.nome
                    FROM categoria
                    WHERE categoria.id = anuncio.id_categoria
                    ) AS categoria
                FROM anuncio
                WHERE anuncio.id_usuario = :id_usuario
                ORDER BY anuncio.id DESC
                LIMIT {$offset}, {$rows}";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
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

    public function editarAnuncio($id, $id_categoria, $titulo, $descricao, $valor, $estado_conservacao, $fotos){
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

        if( count($fotos['tmp_name']) > 0 ){
            for( $i=0; $i<count($fotos['tmp_name']); $i++ ){
                $tipo = $fotos['type'][$i];
                if( in_array($tipo, array('image/jpeg', 'image/png') ) ){
                    $newname = md5(time().rand(0,99999)).'.jpg';
                    move_uploaded_file( $fotos['tmp_name'][$i], 'assets/img/anuncio/' . $newname );
                    list($width_original, $height_original) = getimagesize('assets/img/anuncio/' . $newname);
                    $ratio = $width_original/$height_original;
                    $width = 500;
                    $height = 500;

                    if( $width/$height > $ratio){
                        $width = $height*$ratio;
                    } else {
                        $height = $width/$ratio;
                    }

                    $image = imagecreatetruecolor($width, $height);
                    if($tipo == 'image/jpeg'){
                        $original = imagecreatefromjpeg('assets/img/anuncio/' . $newname);
                    } else if($tipo == 'image/png'){
                        $original = imagecreatefrompng('assets/img/anuncio/' . $newname);
                    }

                    imagecopyresampled($image, $original, 0, 0, 0, 0, $width, $height, $width_original, $height_original);
                    imagejpeg($image, 'assets/img/anuncio/' . $newname, 80);

                    $sql = "INSERT INTO anuncio_imagem SET id_anuncio = :id_anuncio, url = :url";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":id_anuncio", $id);
                    $stmt->bindValue(":url", $newname);
                    $stmt->execute();
                }
            }
        }

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


    public function excluirFoto($id){
        global $pdo;
        $id_anuncio = 0;
        $sql = "SELECT id_anuncio FROM anuncio_imagem WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $id_anuncio = $row['id_anuncio'];

            $sql = "DELETE FROM anuncio_imagem WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if( $stmt->rowCount() > 0){
                return $id_anuncio;
            }
        }
        return $id_anuncio;
    }

}