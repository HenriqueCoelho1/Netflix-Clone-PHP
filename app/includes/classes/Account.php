<?php
class Account{
    private $con;
    private $error_array = array();
    public function __construct($con){
        $this->con = $con;
    }
    public function validate_first_name($fn){
        if(strlen($fn) < 2 || strlen($fn) > 25){
            array_push($this->error_array, "First Name Wrong Length");
        }
    }

    public function get_error($error){
        if(in_array($error, $this->error_array)){
            return $error;
        }
    }
}