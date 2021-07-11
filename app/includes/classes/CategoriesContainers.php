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

    public function show_tv_show_categories(){
        $query = $this->con->prepare("SELECT * FROM categories ");
        $query->execute();

        $html = "<div class='previewCategories'>
                <h1>Tv Shows</h1>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $html .= $this->get_category_html($row, null, true, false);
        }
        return $html . "</div>";
    }

    public function show_movies_categories(){
        $query = $this->con->prepare("SELECT * FROM categories ");
        $query->execute();

        $html = "<div class='previewCategories'>
                <h1>Movies</h1>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $html .= $this->get_category_html($row, null, false, true);
        }
        return $html . "</div>";
    }

    public function show_category($category_id, $title = null){
        $query = $this->con->prepare("SELECT * FROM categories WHERE id = :id ");
        $query->bindValue(":id", $category_id);
        $query->execute();

        $html = "<div class='previewCategories noScroll'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $html .= $this->get_category_html($row, $title, true, true);
        }
        return $html . "</div>";

    }


    private function get_category_html($sql_data, $title, $tv_shows, $movies){
        $category_id = $sql_data["id"];
        $title = $title === null ? $sql_data["name"] : $title;

        if($tv_shows && $movies){
            $entities = EntityProvider::get_entities($this->con, $category_id, 30);
        }else if($tv_shows){
            $entities = EntityProvider::get_tv_show_entities($this->con, $category_id, 30);
            
        }else{
            $entities = EntityProvider::get_movies_entities($this->con, $category_id, 30);
        }

        if(sizeof($entities) == 0){
            return;
        }

        $entities_html = "";
        $preview_provider = new PreviewProvider($this->con, $this->username); 

        foreach($entities as $entity){
            $entities_html .= $preview_provider->entity_preview_square($entity);
        }

        return "<div class='category'>
                    <a href='category.php?id=$category_id'>
                        <h3>$title</h3>
                    </a>

                    <div class='entities'>
                        $entities_html
                    </div>
                </div>";
    }
}