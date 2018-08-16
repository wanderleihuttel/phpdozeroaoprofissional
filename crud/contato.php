<?php
    class Contato {

        private $pdo;

        public function __construct() {
            
            $dsn = "mysql:dbname=crud1;host=localhost;port=3306;charset=utf8;";
            $dbuser = "cursophp";
            $dbpass = "cursophp";

            $options = array (
                PDO::ATTR_CASE => PDO::CASE_LOWER,
                PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            try {
                $this->pdo = new PDO($dsn, $dbuser, $dbpass, $options);
            } catch(PDOException $e) {
                echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
            }
        } // fim constructor


        public function adicionar($email, $nome = null) {
            // 1º passo = verificar se o email já existe no sistema
            // 2º passo = adicionar
            if ( !$this->existeEmail($email) ) {
                $sql = "INSERT INTO contatos (nome, email) VALUES (:nome, :email)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(":nome", $nome);
                $stmt->bindValue(":email", $email);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        } // fim adicionar

        public function getInfo( $id ) {
            $sql = "SELECT * FROM contatos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                return $row;
            } else {
                return array();
            }
        } // fim getNome

        public function getAll() {
            $sql = "SELECT * FROM contatos";
            $stmt = $this->pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetchAll();
                return $row;
            } else {
                return array();
            }
        } //fim getAll

        public function editar($id, $nome) {
            $sql = "UPDATE contatos SET nome = :nome WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":nome", $nome);
            $stmt->execute();
            if ($stmt->rowCount()>0){
                return true;
            } else {
                return false;
            }
        } //fim editar


        public function excluir ($id) {
            $sql = "DELETE FROM contatos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()>0){
                return true;
            } else {
                return false;
            }
        }

        private function existeEmail($email) {
            $sql = "SELECT email FROM contatos WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":email", $email);
            $stmt->execute();

            if($stmt->rowCount()>0){
                return true;
            } else {
                return false;
            }
        } // fim existeEmail
    }
