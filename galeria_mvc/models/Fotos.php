<?php

class Fotos extends Model {

    public function getFotos(){

        $fotos = [];
        $sql = "SELECT id, titulo, url FROM fotos ORDER BY id DESC";
        $stmt = $this->db->query($sql);

        if ( $stmt->rowCount() > 0 ){
            $fotos = $stmt->fetchAll();
        }
        return $fotos;
    } // end method getFotos




    public function saveFotos(){


        if( isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name']) ){

            $filetype = $_FILES['arquivo']['type'];
            $allowed = ['image/jpeg', 'image/jpg', 'image/png'];

            if( in_array($filetype, $allowed ) ) {
                $upload_dir = BASE_DIR . DS . 'assets' . DS . 'img' . DS . 'galeria' . DS ;
                $new_name = md5( time() . rand(0,10000) ) . '.jpg';
                $tmp_name = $_FILES['arquivo']['tmp_name'];
                $titulo = null;

                if( isset($_POST['titulo']) && !empty($_POST['titulo']) ){
                    $titulo = addslashes($_POST['titulo']);
                }

                $sql = 'INSERT INTO fotos (titulo, url) VALUES (:titulo, :url)';
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':titulo', $titulo);
                $stmt->bindValue(':url', $new_name);
                $stmt->execute();
                if( $stmt->rowCount() > 0){
                    move_uploaded_file($tmp_name, $upload_dir . $new_name);
                    return true;
                } else {
                    return false;
                }
            }
        }
    } // end method saveFiles

} // end class Fotos