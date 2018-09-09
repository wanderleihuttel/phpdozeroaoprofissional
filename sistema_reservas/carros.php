<?php

    class Carros{
        private $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;

        }

        public function getCarros(){
            $sql = "SELECT id, nome, placa FROM carros";
            $stmt = $this->pdo->query($sql);
            $carros = [];
            if( $stmt->rowCount() > 0){
                $carros = $stmt->fetchAll();
            }
            return $carros;
        }
    }