<?php
class SearchResultsProvider{
    private $con, $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
    }

    public function get_results($input_text){
        $entities = EntityProvider::get_search_entities($this->con, $input_text);

        $html = "<div class='previewCategories noScroll'>";
        $html.= $this->get_result_html($entities);

        return $html . "</div>";
    }

    public function get_result_html($entities){
        if(sizeof($entities) == 0){
            return;
        }

        $entities_html = "";
        $preview_provider = new PreviewProvider($this->con, $this->username); 

        foreach($entities as $entity){
            $entities_html .= $preview_provider->entity_preview_square($entity);
        }

        return "<div class='category'>
                    <div class='entities'>
                        $entities_html
                    </div>
                </div>";
    }
}