<?php

class Anuncio extends Model {


    public function getTotalAnuncios( $filtro = [] ){

        $array = [];
        $filtrostring = array("1=1");
        if(!empty($filtro['categoria'])){
            $filtrostring[] = 'anuncio.id_categoria = :id_categoria';
        }
        if( isset($filtro['valor_minimo']) && isset($filtro['valor_maximo'])){
            if( $filtro['valor_minimo'] >= 0 && $filtro['valor_maximo'] >=0 ){
                $filtrostring[] = 'anuncio.valor BETWEEN :valor_minimo AND :valor_maximo';
            }
        }
        if( !empty($filtro['estado_conservacao']) ){
            $filtrostring[] = 'anuncio.estado_conservacao = :estado_conservacao';
        }

        $sql = "SELECT count(*) AS total FROM anuncio WHERE " . implode(' AND ', $filtrostring );
        $stmt = $this->db->prepare($sql);

        if(!empty($filtro['categoria'])){
            $stmt->bindValue(":id_categoria", $filtro['categoria']);
        }
        if( isset($filtro['valor_minimo']) && isset($filtro['valor_maximo'])){
            if( $filtro['valor_minimo'] >= 0 && $filtro['valor_maximo'] >=0 ){
                $stmt->bindValue(":valor_minimo", $filtro['valor_minimo']);
                $stmt->bindValue(":valor_maximo", $filtro['valor_maximo']);
            }
        }
        if(!empty($filtro['estado_conservacao'])){
            $stmt->bindValue(":estado_conservacao", $filtro['estado_conservacao']);
        }

        $stmt->execute();
        //print_r($stmt->debugDumpParams());


        if( $stmt->rowCount() > 0 ){
            $row = $stmt->fetch();
            return $row['total'];
        }
    }


    public function getMaxPreco(){
        $sql = "SELECT  MAX(valor) AS maximo FROM anuncio";
        $stmt = $this->db->query($sql);
        if( $stmt->rowCount() > 0 ){
            $row = $stmt->fetch();
            return $row['maximo'];
        }
    }




    public function getAnuncioById($id) {
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
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetch();
            $array['fotos'] = [];
            $sql = "SELECT id, url FROM anuncio_imagem WHERE id_anuncio = :id_anuncio";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id_anuncio",$id);
            $stmt->execute();
            if( $stmt->rowCount() > 0){
                $array['fotos'] = $stmt->fetchAll();
            }
        }
        return $array;
    }



    public function getUltimosAnuncios($pagina_atual, $item_por_pagina, $filtro){

        $offset = ($pagina_atual -1) * $item_por_pagina;
        $rows = $item_por_pagina;

        $array = [];
        $filtrostring = array("1=1");
        if( !empty($filtro['valor_minimo']) ){
            //$filtro['valor_minimo'] = 0;
        }

        if( !empty($filtro['categoria']) ){
            $filtrostring[] = 'anuncio.id_categoria = :id_categoria';
        }
        if( $filtro['valor_minimo'] >= 0 && $filtro['valor_maximo'] >=0 ){
            $filtrostring[] = 'anuncio.valor BETWEEN :valor_minimo AND :valor_maximo';
        }
        if( !empty($filtro['valor_minimo']) && !empty($filtro['valor_maximo']) ){
            $filtrostring[] = 'anuncio.valor BETWEEN :valor_minimo AND :valor_maximo';
        }
        if( !empty($filtro['estado_conservacao']) ){
            $filtrostring[] = 'anuncio.estado_conservacao = :estado_conservacao';
        }


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
                WHERE " . implode(' AND ', $filtrostring ) . "
                ORDER BY anuncio.id DESC
                LIMIT {$offset}, {$rows}";

        $sql2 = "SELECT anuncio.id, anuncio.id_usuario, anuncio.id_categoria, anuncio.titulo, anuncio.descricao, anuncio.valor, anuncio.estado_conservacao,
                (SELECT anuncio_imagem.url FROM anuncio_imagem WHERE anuncio_imagem.id_anuncio = anuncio.id LIMIT 1 ) AS url, categoria.nome AS categoria
                FROM anuncio
                LEFT JOIN categoria ON (anuncio.id_categoria = categoria.id)
                WHERE " . implode(' AND ', $filtrostring ) . "
                ORDER BY anuncio.id DESC
                LIMIT 0, 2";


        $stmt = $this->db->prepare($sql);
        if( !empty($filtro['categoria']) ){
            $stmt->bindValue(":id_categoria", $filtro['categoria']);
        }
        if( $filtro['valor_minimo'] >= 0 && $filtro['valor_maximo'] >=0 ){
            $stmt->bindValue(":valor_minimo", $filtro['valor_minimo']);
            $stmt->bindValue(":valor_maximo", $filtro['valor_maximo']);
        }
        if(!empty($filtro['estado_conservacao'])){
            $stmt->bindValue(":estado_conservacao", $filtro['estado_conservacao']);
        }
        //echo "<pre>";
        //print_r( $stmt->debugDumpParams() );
        //echo "</pre>";
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
        }
        return $array;
    }

    public function getMeusAnuncios(){
        $array = [];
        $sql = "SELECT *,
                    (SELECT anuncio_imagem.url
                    FROM anuncio_imagem
                    WHERE anuncio_imagem.id_anuncio = anuncio.id LIMIT 1
                    ) AS url
                FROM anuncio
                WHERE anuncio.id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_usuario", $_SESSION['cLogin']);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $array = $stmt->fetchAll();
        }
        return $array;
    }


    public function adicionarAnuncio($id_categoria, $titulo, $descricao, $valor, $estado_conservacao){

        $sql = "INSERT INTO anuncio (id_usuario, id_categoria, titulo, descricao, valor, estado_conservacao) VALUES
                (:id_usuario, :id_categoria, :titulo, :descricao, :valor, :estado_conservacao)";
        $stmt = $this->db->prepare($sql);
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

        $sql = "UPDATE anuncio SET
                id_categoria = :id_categoria,
                titulo = :titulo,
                descricao= :descricao,
                valor = :valor,
                estado_conservacao = :estado_conservacao
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
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
                    $stmt = $this->db->prepare($sql);
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

        $sql1 = "DELETE FROM anuncio_imagem WHERE id_anuncio = :id";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->bindValue(":id", $id);
        $stmt1->execute();

        $sql2 = "DELETE FROM anuncio WHERE id = :id";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(":id", $id);
        $stmt2->execute();

        if( $stmt1->rowCount() > 0 && $stmt2->rowCount() > 0 ){
            return true;
        } else {
            return false;
        }
    }


    public function excluirFoto($id){

        $id_anuncio = 0;
        $sql = "SELECT id_anuncio FROM anuncio_imagem WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $id_anuncio = $row['id_anuncio'];

            $sql = "DELETE FROM anuncio_imagem WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if( $stmt->rowCount() > 0){
                return $id_anuncio;
            }
        }
        return $id_anuncio;
    }


}