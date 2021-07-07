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

    public function get_id(){
        return $this->sql_data["id"];
    }
    public function get_title(){
        return $this->sql_data["title"];
    }
    public function get_description(){
        return $this->sql_data["description"];
    }
    public function get_file_path(){
        return $this->sql_data["filePath"];
    }
    public function get_video(){
        return $this->sql_data["video"];
    }
    public function get_thumbnail(){
        return $this->entity->get_thumbnail();
    }
    public function get_episode_number(){
        return $this->sql_data["episode"];
    }

    public function increment_views(){
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id", $this->get_id());
        $query->execute();
    }
}