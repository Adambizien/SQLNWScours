<?php

    abstract class PDOManagerClass {
        private $host;
        private $username;
        private $password;
        private $port;
    
        private $db_name;
        private $pdo;
    
        public function __construct(string $DBName) {
            $this->db_name = $DBName;
            $this->jsonConnect();
            $this->connect();
        }
        private function jsonConnect(){
            $config = file_get_contents('./configs/config.json');
            $config = json_decode($config, true);
            $this->host = $config['host'];
            $this->username = $config['user'];
            $this->password = $config['password'];
            $this->port = $config['port'];
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
        public function getExecute($query){
            $statement = $this->pdo->prepare($query);
            try{
                $statement ->execute();
                while($line = $statement->fetch(PDO::FETCH_ASSOC)){
                    $data[]=$line;
                }
                return $data;
            } catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
            return false;
        }
        public function setExecute($query){
            $statement = $this->pdo->prepare($query);
            try{
                $statement ->execute();
                return true;
            } catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
            return false;
        }

       
        public function findAll(string $table): array{
            $data = [];
            $query ="SELECT * FROM $table";
            return $this->getExecute($query);
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
           return  $this->getExecute($query);
        }
        public function create(string $table,$payload ): bool{
            $query = "INSERT INTO $table ( ";
            $first = false;
            $table = '(';
            foreach($payload as $key=>$value){
                if(!$first){
                    $query .='`'.htmlspecialchars($key).'`';
                    $table .= '"'.htmlspecialchars($value).'"';
                    $first = true;
                }else{
                    $query .=',`'.htmlspecialchars($key).'`';
                    $table .= ",". '"'.htmlspecialchars($value).'"';
                }
            }
            $query .= ') VALUES '.$table.')';
            return $this->setExecute($query);
        }
        public function delete(string $table,int $id){
            $query = "DELETE FROM $table WHERE id = $id";
            return $this->setExecute($query);
        }

        public function toManyDelete(string $table,array $id){
            foreach($id as $value){
                $this->delete($table,$value);
            }
        }

        public function update(string $table,array $payload,int $id){
            $first = false;
            $query ="UPDATE $table SET ";
            foreach($payload as $key => $value){
                if(!$first){
                    $query .= '`'.$key.'` = "'.htmlspecialchars($value).'"';
                    $first = true;
                }else{
                    $query .= ",".'`'.$key.'` = "'.htmlspecialchars($value).'"';
                }
            }
            $query .= " WHERE id = ".htmlspecialchars($id);
            return $this->setExecute($query);
        }
        
            


        function getRelation($tables, $columns, $conditions = [], $orderBy = []) {
            $query = "SELECT ";
            if (!empty($columns)) {
                $query .= implode(',', $columns);
            } else {
                $query .= '*';
            }
            $query .= " FROM ";

            $numTables = count($tables);
            $query .= $tables[0][0];
            $query .= " INNER JOIN {$tables[1][0]} ON {$tables[1][0]}.{$tables[1][1]} = {$tables[0][0]}.{$tables[0][1]}";
            
            $query .= " WHERE ";
            if (!empty($conditions)) {
                $query .= implode(' AND ', $conditions);
            } else {
                $query .= '1';
            }
            if (!empty($orderBy)) {
                $query .= " ORDER BY ";
                $orderByStrings = [];
        
                foreach ($orderBy as $column => $direction) {
                    $orderByStrings[] = "$column $direction";
                }
        
                $query .= implode(', ', $orderByStrings);
            }
            return $this->getExecute($query);
        }
        // public function getRelation(
        //     array $relation, 
        //     string $select = null, 
        //     array $criteria, 
        //     array $order = null
        //     ): array {
        //         $primaryTable = $relation[0];
        //         $secondaryTable = $relation[1];
        
        //         $query = "SELECT * FROM $primaryTable[0]";
        //         if(!is_null($select)){
        //             $query = "SELECT $select FROM $primaryTable[0]";
        //         }
        
        //         $query .= " INNER JOIN $secondaryTable[0] ON $primaryTable[0].$primaryTable[1] = $secondaryTable[0].$secondaryTable[1]";
        
        //         if (count($criteria) > 0) {
        //             $query .= " WHERE ";
        
        //             $n = 0;
        //             foreach ($criteria as $index => $value) {
        //                 $query .= $index . " = '" . $value . "'";
        
        //                 if ($n < count($criteria) - 1) {
        //                     $query .= " AND ";
        //                 }
        //                 $n++;
        //             }
        //         }
        
        //         if (!is_null($order)) {
        //             $arrayIndex = array_keys($order);
        //             $query .= "  ORDER BY " . $arrayIndex[0] . " " . $order[$arrayIndex[0]];
        //         }
        
        //         $prepare = $this->pdo->prepare($query);
        //         $prepare->execute();
        //         while ($line = $prepare->fetch(PDO::FETCH_ASSOC)) {
        //             $data[] = $line;
        //         }
        //         return $data;
        //     }
    }