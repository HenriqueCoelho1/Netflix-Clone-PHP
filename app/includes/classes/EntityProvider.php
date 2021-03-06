<?php
class EntityProvider {
    public static function get_entities($con, $category_id, $limit){
        $sql = "SELECT * FROM entities ";

        if($category_id !== null){
            $sql .= "WHERE categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query = $con->prepare($sql);

        if($category_id !== null){
            $query->bindValue(":categoryId", $category_id);
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row);
        }
        return $result;
    }

    public static function get_tv_show_entities($con, $category_id, $limit){
        $sql = "SELECT DISTINCT(entities.id) FROM entities 
        INNER JOIN videos 
        ON entities.id = videos.entityId
        WHERE videos.isMovie = 0 ";

        if($category_id !== null){
            $sql .= "AND categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query = $con->prepare($sql);

        if($category_id !== null){
            $query->bindValue(":categoryId", $category_id);
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row["id"]);
        }
        return $result;
    }

    public static function get_movies_entities($con, $category_id, $limit){
        $sql = "SELECT DISTINCT(entities.id) FROM entities 
        INNER JOIN videos 
        ON entities.id = videos.entityId
        WHERE videos.isMovie = 1 ";

        if($category_id !== null){
            $sql .= "AND categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query = $con->prepare($sql);

        if($category_id !== null){
            $query->bindValue(":categoryId", $category_id);
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row["id"]);
        }
        return $result;
    }

    public static function get_search_entities($con, $term){
        $sql = "SELECT * FROM entities 
        WHERE name LIKE CONCAT('%', :term, '%') LIMIT 30 ";


        $query = $con->prepare($sql);


        $query->bindValue(":term", $term);
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row);
        }
        return $result;
    }
}