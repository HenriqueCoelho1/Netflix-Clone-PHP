<?php
class Entity {
    private $con, $sql_data;
    public function __construct($con, $input){
        $this->con = $con;
        if(is_array($input)){
            $this->sql_data = $input;
        }else{
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sql_data = $query->fetch(PDO::FETCH_ASSOC);
        }
        
    }
    public function get_id(){
        return $this->sql_data["id"];
    }

    public function get_name(){
        return $this->sql_data["name"];
    }

    public function get_thumbnail(){
        return $this->sql_data["thumbnail"];
    }

    public function get_preview(){
        return $this->sql_data["preview"];
    }

}