<?php

    class PDOManagerClass {
        private $host = 'localhost';
        private $username = 'adam';
        private $password = 'motherload';
        private $port = 3306;
    
        private $db_name;
        private $pdo;
    
        public function __construct(string $DBName) {
            $this->db_name = $DBName;
            $this->connect();
        }
    
        private function connect() : bool {
            try {
                $pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name", $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
                return true;
            } catch (PDOException $e) {
                return false;
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        public function findAll(string $table): array{
            $data = [];
            $query ="SELECT * FROM $table";
            $prepare = $this->pdo->prepare($query);
            $prepare->execute();
            while($line = $prepare->fetch(PDO::FETCH_ASSOC)){
                $data[]=$line;
            }
            return $data;
        }
        public function findBy(string $table, array $column,array $order=null): array{
            $data = [];
            $first = true;
            $query ="SELECT * FROM $table ";
            foreach ($column as $key => $value) {
                if($first){
                    $query .= "WHERE $key = $value ";
                    $first = false;
                }else{
                    $query .= "AND $key = $value ";
                }
            }
            if(!is_null($order)){
                $first = true;
                foreach ($order as $key => $value) {
                    if($first){
                        $query .= "ORDER BY $key  $value ";
                        $first = false;
                    }else{
                        $query .= ", $key  $value ";
                    }
                }
            }
            $prepare = $this->pdo->prepare($query);
            $prepare->execute();
            while($line = $prepare->fetch(PDO::FETCH_ASSOC)){
                $data[]=$line;
            }
            return $data;
        }
    }