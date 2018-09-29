<?php

class Usuario extends Model {

    public function cadastrar($nome, $email, $telefone, $senha){

        $sql = "SELECT id FROM usuario WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if( $stmt->rowCount() == 0 ) {
            $sql = "INSERT INTO usuario (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":telefone", $telefone);
            $stmt->bindValue(":senha", md5($senha) );
            $stmt->execute();
            if( $stmt->rowCount() > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } // function cadastrar


    public function login($email, $senha){

        $sql = "SELECT id FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", md5($senha) );
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $_SESSION['cLogin']   = $row['id'];
            return true;
        } else {
            return false;
        }

    } // function login


    public function getUserNameById($id){

        $sql = "SELECT nome FROM usuario WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            $row = $stmt->fetch();
            return $row['nome'];
        } else {
            return false;
        }
    }

    public function getTotalUsuarios(){

        $sql = "SELECT count(*) AS total FROM usuario";
        $stmt = $this->db->query($sql);
        if( $stmt->rowCount() > 0 ){
            $row = $stmt->fetch();
            return $row['total'];
        }
    }
}