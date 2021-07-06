<?php
class SeasonProvider {
    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
        
    }

    public function create($entity){
        $seasons = $entity->get_seasons();

        if(sizeof($seasons) == 0){
            return;
        }
        $season_html = "";
        
        foreach ($seasons as $season) {
            $season_number = $season->get_season_number();
            $video_html = "";
            foreach ($season->get_videos() as $video) {
                $video_html .= $this->create_video_square($video);
            }
            $season_html .= "<div class='season'>
                                <h3>Season $season_number</h3>
                                <div class='videos'>
                                    $video_html
                                </div>
            
                            </div>";
        }
        return $season_html;
    }

    private function create_video_square($video){
        $id = $video->get_id();
        $thumbnail = $video->get_thumbnail();
        $title = $video->get_title();
        $description = $video->get_description();
        $episode_number = $video->get_episode_number();

        return "<a href='watch.php?id=$id'>
                    <div class='episodeContainer'>
                        <div class='contents'>
                            <img src='$thumbnail' />

                            <div class='videoInfo'>
                                <h4>$episode_number. $title</h4>
                                <span>$description</span>
                            </div>
                        </div>
                    </div>
                <a/>";
    }
}