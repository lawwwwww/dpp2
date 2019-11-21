<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "employeetable";
 
    // object properties
    public $empid;
    public $name;
	public $address;
	public $contactinfo;
	public $role;
	public $gender;
	public $email;
	public $password;
	public $hiredate;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email, password=:password, role =:role, hiredate=:hiredate";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
		$this->role=htmlspecialchars(strip_tags($this->role));
        $this->hiredate=htmlspecialchars(strip_tags($this->hiredate));
 
        // bind values
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
		$stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":hiredate", $this->hiredate);

    
        // execute query
        if($stmt->execute()){
            $this->empid = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `empid`, `email`, `password`, `hiredate`,`role`
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='".$this->email."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
	
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}