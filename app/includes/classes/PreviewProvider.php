<?php 
class PreviewProvider {
    private $con, $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
    }

    public function create_preview_video($entity){
        if($entity === null){
            $entity = $this->get_random_entity();
        }

        $id = $entity->get_id();
        $name = $entity->get_name();
        $preview = $entity->get_preview();
        $thumbnail = $entity->get_thumbnail();
        echo "<img src='$thumbnail' />";
    }

    private function get_random_entity(){
        $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return new Entity($this->con, $row);

    }
}