<?php

class Model {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = 'Mochaoreo0429!';
    private $dbname = 'crudoperation';
    private $conn;

    function __construct(){
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error) {
            echo 'Connection Failed';
        } else {
            return $this->conn;
        }
    }
    public function insertRecord($post) {
        $firstname = $post['firstname'];
        $lastname = $post['lastname'];
        $number = $post['number'];
        $sql = "INSERT INTO user (firstname, lastname, `number`) VALUES ('$firstname', '$lastname', '$number')";
        $result = $this->conn->query($sql);
        if($result) {
            header('location:index.php');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }
    }

    public function updateRecord($post) {
        $firstname = $post['firstname'];
        $lastname = $post['lastname'];
        $number = $post['number'];
        $editid = $post['hid'];
        $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', `number`='$number' WHERE id='$editid'";
        $result = $this->conn->query($sql);
        if($result) {
            header('location:index.php');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }
    }

    public function deleteRecord($delid) {
        $sql = "DELETE FROM user WHERE id = '$delid'";
        $result = $this->conn->query($sql);
        if($result) {
            header('location:index.php');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }
    }

    public function displayRecord() {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);
        if($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function displayRecordById($editid) { 
        $sql = "SELECT * FROM user WHERE id = '$editid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows==1) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
}

?>