<?php 


class VideoProvider{
    public static function get_up_next($con, $current_video){
        $query = $con->prepare("SELECT * FROM videos WHERE entityId=:entityId AND id!=:videoId
        AND ((season = :season AND episode > :episode) OR season > :season)
        ORDER BY season, episode ASC LIMIT 1");

        $query->bindValue(":entityId", $current_video->get_entity_id());
        $query->bindValue(":season", $current_video->get_season_number());
        $query->bindValue(":episode", $current_video->get_episode_number());
        $query->bindValue(":videoId", $current_video->get_id());

        $query->execute();

        if($query->rowCount() === 0){
            $query = $con->prepare("SELECT * FROM videos WHERE season <=1 AND episode <=1 AND id != :videoId
            ORDER BY views DESC LIMIT 1");
            $query->bindValue(":videoId", $current_video->get_id());
            $query->execute();
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        return new Video($con, $row);
    }
    
}
