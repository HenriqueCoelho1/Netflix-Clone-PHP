<?php
class Season {
    private $season_number , $videos;

    public function __construct($season_number, $videos){
        $this->season_number = $season_number;
        $this->videos = $videos;
    }

    public function get_season_number(){
        return $this->season_number;
    }

    public function get_videos(){
        return $this->videos;
    }
}