<?php
class User {
    private $con, $sql_data;

    public function __construct($con, $username){
        $this->con = $con;
        

        $query = $con->prepare("SELECT * FROM user WHERE username = :username");
        $query->bindValue(":username", $username);
        $query->execute();

        $this->sql_data = $query->fetch(PDO::FETCH_ASSOC);
    }


    public function get_firstname(){
        return $this->sql_data["firstname"];
    }
    public function get_lastname(){
        return $this->sql_data["lastname"];
    }
    public function get_email(){
        return $this->sql_data["email"];
    }




}