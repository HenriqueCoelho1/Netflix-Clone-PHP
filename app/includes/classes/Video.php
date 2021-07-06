<?php
class Video {
    private $con, $sql_data, $entity;
    public function __construct($con, $input){
        $this->con = $con;
        if(is_array($input)){
            $this->sql_data = $input;
        }else{
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sql_data = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($con, $this->sql_data["entityId"]);
        
    }
}