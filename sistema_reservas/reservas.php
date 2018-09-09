<?php

    class Reservas{
        private $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;

        }

        public function getReservas($data_inicial, $data_final){
            $sql = "SELECT r.id, r.id_carro, r.data_inicial, r.data_final, r.pessoa, c.nome
                    FROM reservas r
                    INNER JOIN carros c ON (r.id_carro = c.id)
                    WHERE NOT (data_inicial > :data_final OR data_final < :data_inicial)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':data_inicial', $data_inicial);
            $stmt->bindValue(':data_final', $data_final);
            $stmt->execute();
            $reservas = [];
            if( $stmt->rowCount() > 0){
                $reservas = $stmt->fetchAll();
            }
            return $reservas;
        }

        public function verificarDisponibilidade($carro, $data_inicial, $data_final){
            $sql = "SELECT * FROM reservas WHERE id_carro = :carro AND NOT (data_inicial > :data_final OR data_final < :data_inicial)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':carro', $carro);
            $stmt->bindValue(':data_inicial', $data_inicial);
            $stmt->bindValue(':data_final', $data_final);
            $stmt->execute();

            if( $stmt->rowCount() > 0 ){
                return false;
            } else {
                return true;
            }
        }


        public function reservar($carro, $data_inicial, $data_final, $pessoa){
            $sql = "INSERT INTO reservas (id_carro, data_inicial, data_final, pessoa) VALUES (:carro, :data_inicial, :data_final, :pessoa)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':carro', $carro);
            $stmt->bindValue(':data_inicial', $data_inicial);
            $stmt->bindValue(':data_final', $data_final);
            $stmt->bindValue(':pessoa', $pessoa);
            $stmt->execute();
            if( $stmt->rowCount() > 0 ){
                return false;
            } else {
                return true;
            }
        }
    }