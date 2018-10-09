<?php

class Contatos extends Model {

    public function insert($nome, $email) {
        // 1º passo = verificar se o email já existe no sistema
        // 2º passo = adicionar
        if ( !$this->email_exists($email) ) {
            $sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    } // end method insert


    public function edit($id, $nome, $email) {
        if ($this->getEmail($id) == $email){
            $sql = "UPDATE contatos SET nome = :nome WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":nome", $nome);
            $stmt->execute();
            return true;
        } else if ($this->getEmail($id) != $email){
            if(!$this->email_exists($email)){
                $sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->bindValue(":nome", $nome);
                $stmt->bindValue(":email", $email);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        if(!$this->email_exists($email)){
            $sql = "UPDATE contatos SET nome = :nome, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }
    // end method edit

    public function delete($id){
        $sql = "DELETE FROM contatos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if( $stmt->rowCount() > 0){
            return true;
        }
        return false;
    }


    public function getAll() {
        $data = [];
        $sql = "SELECT * FROM contatos ORDER BY nome";
        $stmt = $this->db->query($sql);
        if( $stmt->rowCount() > 0){
            $data = $stmt->fetchAll();
        }
        return $data;
    } // end method getAll


    public function getById( $id ) {
        $sql = "SELECT * FROM contatos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            return $row;
        } else {
            return array();
        }
    } // end method getById

    private function email_exists($email) {
        $sql = "SELECT email FROM contatos WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        } else {
            return false;
        }
    } // end method email_exists


    public function getEmail($id) {
        $sql = "SELECT email FROM contatos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
         if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            return $row['email'];
        } else {
            return false;
        }
     }
     // end method getEmail

} // end class Contatos