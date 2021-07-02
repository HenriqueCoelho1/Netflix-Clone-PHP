<?php
class CategoriesContainers {
    private $con, $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
    }

    public function show_all_categories(){
        $query = $this->con->prepare("SELECT * FROM categories ");
        $query->execute();

        $html = "<div class='previewCategories'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $html .= $this->get_category_html($row, null, true, true);
        }
        return $html . "</div>";
    }


    private function get_category_html($sql_data, $title, $tv_shows, $movies){
        $category_id = $sql_data["id"];
        $title = $title === null ? $sql_data["name"] : $title;

        if($tv_shows && $movies){
            $entities = EntityProvider::get_entities($this->con, $category_id, 30);
        }else if($tv_shows){
            //get tv shows
            
        }else{
            //get movies

        }

        if(sizeof($entities) == 0){
            return;
        }

        $entities_html = "";

        foreach($entities as $entity){
            $entities_html .= $entity->get_name();
        }

        return $entities_html . "<br />";
    }
}