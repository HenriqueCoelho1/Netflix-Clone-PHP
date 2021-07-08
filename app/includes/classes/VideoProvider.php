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

    public static function get_entity_video_for_user($con, $entity_id, $username){
        $query = $con->prepare("SELECT video_id FROM video_progress 
        INNER JOIN videos ON video_progress.video_id = videos.id
        WHERE videos.entityId = :entityId 
        AND video_progress.username = :username
        ORDER BY video_progress.date_modified DESC
        LIMIT 1;");

        $query->bindValue(":entityId", $entity_id);
        $query->bindValue(":username", $username);

        $query->execute();

        if($query->rowCount() === 0){
            $query = $con->prepare("SELECT id FROM videos WHERE entityId=:entityId 
            ORDER BY season, episode ASC LIMIT 1");
            $query->bindValue(":entityId", $entity_id);
            $query->execute();
        }

        return $query->fetchColumn();

    }
    
}
