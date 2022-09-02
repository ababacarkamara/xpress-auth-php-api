<?php
    class User{
        // Connection
        private $conn;
        // Table
        private $db_table = "user";
        // Columns
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $userPassword;
        public $phone;
        public $created_at;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL USERS
        public function getUsers(){
            $sqlQuery = "SELECT id, firstname, lastname, email, phone, created_at FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE USER
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        firstname = :firstname, 
                        lastname = :lastname,
                        email = :email, 
                        password = :userPassword,
                        phone = :phone, 
                        created_at = :created_at";        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            // $this->userPassword=htmlspecialchars(strip_tags($this->userPassword));
            $this->created_at=htmlspecialchars(strip_tags($this->created_at));

            // bind data
            $stmt->bindParam(":firstname", $this->firstname);
            $stmt->bindParam(":lastname", $this->lastname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":userPassword", $this->userPassword);        
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":created_at", $this->created_at);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // GET SINGLE USER
        public function getSingleUser(){
            $sqlQuery = "SELECT
                        id, 
                        firstname, 
                        lastname,
                        email, 
                        phone, 
                        created_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($dataRow != NULL) {
                $this->firstname = $dataRow['firstname'];
                $this->lastname = $dataRow['lastname'];
                $this->email = $dataRow['email'];
                $this->phone = $dataRow['phone'];
                $this->created_at = $dataRow['created_at'];
            }


        }        
        // UPDATE USER
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        firstname = :firstname, 
                        lastname = :lastname,
                        email = :email, 
                        user_password = :userPassword,
                        phone = :phone, 
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->userPassword=htmlspecialchars(strip_tags($this->userPassword));
            $this->id=htmlspecialchars(strip_tags($this->id));

        
            // bind data
            $stmt->bindParam(":firstname", $this->firstname);
            $stmt->bindParam(":lastname", $this->lastname);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":userPassword", $this->userPassword);
            $stmt->bindParam(":id", $this->id);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteUser(){
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