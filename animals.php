<?php
    class Animals{

        // Connection
        private $conn;

        // Table
        private $db_table = "Animal";

        // Columns
        public $id;
        public $name;
        public $animal;
        public $age;
        public $born;
        public $hungry;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAnimal(){
            $sqlQuery = "SELECT id, name, animal, age, born, hungry FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createAnimal(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        animal = :animal, 
                        age = :age, 
                        born = :born, 
                        hungry = :hungry";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->animal=htmlspecialchars(strip_tags($this->animal));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->born=htmlspecialchars(strip_tags($this->born));
            $this->hungry=htmlspecialchars(strip_tags($this->hungry));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":animal", $this->animal);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":born", $this->born);
            $stmt->bindParam(":hungry", $this->hungry);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleAnimal(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        animal, 
                        age, 
                        born, 
                        hungry
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->animal = $dataRow['animal'];
            $this->age = $dataRow['age'];
            $this->born = $dataRow['born'];
            $this->hungry = $dataRow['hungry'];
        }        

        // UPDATE
        public function updateAnimal(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        animal = :animal, 
                        age = :age, 
                        born = :born, 
                        hungry = :hungry
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->animal=htmlspecialchars(strip_tags($this->animal));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->born=htmlspecialchars(strip_tags($this->born));
            $this->hungry=htmlspecialchars(strip_tags($this->hungry));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":animal", $this->animal);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":born", $this->born);
            $stmt->bindParam(":hungry", $this->hungry);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteAnimal(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

