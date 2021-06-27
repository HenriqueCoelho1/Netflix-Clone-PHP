<?php
class Account{
    private $con;
    private $error_array = array();
    public function __construct($con){
        $this->con = $con;
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
        $this->validate_first_name($fn);
        $this->validate_last_name($ln);

    }
    private function validate_first_name($fn){
        if(strlen($fn) < 2 || strlen($fn) > 25){
            array_push($this->error_array, Constants::$first_name_characters);
        }
    }
    private function validate_last_name($ln){
        if(strlen($ln) < 2 || strlen($ln) > 25){
            array_push($this->error_array, Constants::$last_name_characters);
        }
    }

    public function get_error($error){
        if(in_array($error, $this->error_array)){
            return $error;
        }
    }
}