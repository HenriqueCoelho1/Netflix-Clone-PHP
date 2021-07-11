<?php 
class PreviewProvider {
    private $con, $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
    }

    public function create_tv_show_preview_video(){
        $entities_array = EntityProvider::get_tv_show_entities($this->con, null, 1);

        if(sizeof($entities_array) === 0){
            ErrorMessage::show("No TV shows displayed");
        }

        return $this->create_preview_video($entities_array[0]);
    }

    public function create_movies_preview_video(){
        $entities_array = EntityProvider::get_movies_entities($this->con, null, 1);

        if(sizeof($entities_array) === 0){
            ErrorMessage::show("No Movie to display");
        }

        return $this->create_preview_video($entities_array[0]);
    }

    public function create_category_preview_video($category_id){
        $entities_array = EntityProvider::get_entities($this->con, $category_id, 1);

        if(sizeof($entities_array) === 0){
            ErrorMessage::show("No Category to display");
        }

        return $this->create_preview_video($entities_array[0]);
    }

    public function create_preview_video($entity){
        if($entity === null){
            $entity = $this->get_random_entity();
        }

        $id = $entity->get_id();
        $name = $entity->get_name();
        $preview = $entity->get_preview();
        $thumbnail = $entity->get_thumbnail();

        $video_id = VideoProvider::get_entity_video_for_user($this->con, $id, $this->username);

        $video = new Video($this->con, $video_id);

        $in_progress_video = $video->is_in_progress($this->username);
        $play_button_text = $in_progress_video ? "Continue Watching" : "Play";


        $season_episode = $video->get_season_and_episode();
        $sub_heading = $video->is_movie() ? "" : "<h4>$season_episode</h4>";

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden />
                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4' />
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            $sub_heading
                            <div>
                                <button onclick='watchVideo($video_id)'><i class='fa fa-play'></i> $play_button_text</button>
                                <button onclick='volumeToggle(this)'><i class='fa fa-volume-mute'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    public function entity_preview_square($entity){
        $id = $entity->get_id();
        $thumbnail = $entity->get_thumbnail();
        $name = $entity->get_name();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name' />
                    </div>
                </a>";

    }
    private function get_random_entity(){
        $entity = EntityProvider::get_entities($this->con, null, 1);
        return $entity[0];

    }
}