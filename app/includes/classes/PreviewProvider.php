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

        $video_id = VideoProvider::get_entity_video_for_user($this->con, $id, $this->username);

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden />
                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4' />
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            <div>
                                <button onclick='watchVideo($video_id)'><i class='fa fa-play'></i> Play</button>
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