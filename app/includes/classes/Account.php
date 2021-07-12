<?php
class Account{
    private $con;
    private $error_array = array();
    public function __construct($con){
        $this->con = $con;
    }

    public function update_details($fn, $ln, $em, $un){
        $this->validate_first_name($fn);
        $this->validate_last_name($ln);
        $this->validate_new_email($em, $un);


        if(empty($this->error_array)){
            $query = $this->con->prepare("UPDATE user SET firstname=:fn, lastname=:ln, email=:em
                                        WHERE username=:un");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);
            
            return $query->execute();
        }
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
        $this->validate_first_name($fn);
        $this->validate_last_name($ln);
        $this->validate_username($un);
        $this->validate_email($em, $em2);
        $this->validate_password($pw, $pw2);

        if(empty($this->error_array)){
            return $this->insert_user_details($fn, $ln, $un, $em, $pw);

        }
        return false;
    }

    public function login($un, $pw){
        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("SELECT * FROM user WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() === 1){
            return true;
        }

        array_push($this->error_array, Constants::$login_failed);
        return false;

    }

    private function insert_user_details($fn, $ln, $un, $em, $pw){
        $pw = hash("sha512", $pw);

        $query = $this->con->prepare("INSERT INTO user (firstname, lastname, username, email, password)
                                        VALUES (:fn, :ln, :un, :em, :pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
    }

    private function validate_username($un){
        if(strlen($un) < 2 || strlen($un) > 25){
            array_push($this->error_array, Constants::$username_characters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM user WHERE username = :un");
        $query->bindValue(":un", $un);

        $query->execute();

        if($query->rowCount() !== 0){
            array_push($this->error_array, Constants::$username_taken);
        }
    }
    private function validate_email($em, $em2){
        if($em !== $em2){
            array_push($this->error_array, Constants::$email_dont_match);
            return;
        }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->error_array, Constants::$email_invalid);
        }

        $query = $this->con->prepare("SELECT * FROM user WHERE email = :em");
        $query->bindValue(":em", $em);
        $query->execute();
        if($query->rowCount() !== 0){
            array_push($this->error_array, Constants::$email_taken);
        }
        
    }

    private function validate_new_email($em, $un){

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->error_array, Constants::$email_invalid);
        }

        $query = $this->con->prepare("SELECT * FROM user WHERE email = :em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);
        $query->execute();
        if($query->rowCount() !== 0){
            array_push($this->error_array, Constants::$email_taken);
        }
        
    }

    private function validate_password($pw, $pw2){
        if($pw !== $pw2){
            array_push($this->error_array, Constants::$password_dont_match);
            return;
        }
        if(strlen($pw) < 2 || strlen($pw2) > 25){
            array_push($this->error_array, Constants::$password_length);
        }
    }

    private function validate_first_name($fn){
        if(strlen($fn) < 6 || strlen($fn) > 25){
            array_push($this->error_array, Constants::$password_length);
        }
    }
    private function validate_last_name($ln){
        if(strlen($ln) < 2 || strlen($ln) > 25){
            array_push($this->error_array, Constants::$last_name_characters);
        }
    }
    
    public function get_error($error){
        if(in_array($error, $this->error_array)){
            return "<span class='errorMessage'>$error</span>";
        }
    }
}