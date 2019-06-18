<?php
class db {

    protected $host, $username, $password, $dbname;
    private $conn;
    public function __construct($host = "localhost", $username = "root", $password = "", $dbname = 'blogg')
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    //alle data ophalen
    public function getAllData($table = null){
        $stmt = $this->conn->prepare("SELECT * FROM ".$table); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    //alle data ophalen en id meegeven
    public function getDataById($table = null, $id = null){
        $stmt = $this->conn->prepare("SELECT * FROM ".$table." WHERE post_id =".$id); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    //een post verwijderen
    public function deleteDataById($table = null, $id = null){
        $stmt = $this->conn->prepare("DELETE FROM ".$table." WHERE post_id =".$id); 
        $stmt->execute();
    }

    //invoegen van een nieuwe post
    public function createData($table = null, $title=null, $body=null){
        $stmt = $this->conn->prepare("INSERT INTO `posts` (`title`, `body`) VALUES ('".$title."','".$body."')");
        $stmt->execute();
    }


    // updaten van bestaande post met id
    public function updateData($table = null, $post_id=null, $title=null, $body=null){
        $stmt = $this->conn->prepare("UPDATE ".$table." SET `title` = '".$title."', `body` = '".$body."' WHERE post_id = ".$post_id."");
        $stmt->execute();
    }

    
}