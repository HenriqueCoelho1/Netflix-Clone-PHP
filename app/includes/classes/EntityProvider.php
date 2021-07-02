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
}