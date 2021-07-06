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

    public function get_seasons(){
        $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id 
        AND isMovie=0 ORDER BY season, episode ASC "); 
        
        $query->bindValue(":id", $this->get_id());
        $query->execute();

        $seasons = array();
        $videos = array();
        $current_season = null;

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            if($current_season !== null && $current_season !== $row["season"]){
                $seasons[] = new Season($current_season, $videos);
                $videos = array();
            }
            $current_season = $row["season"];
            $videos[] = new Video($this->con, $row);
        }

        if(sizeof($videos) !== 0){
            $seasons[] = new Season($current_season, $videos);

        }

        return $seasons;
    }


}