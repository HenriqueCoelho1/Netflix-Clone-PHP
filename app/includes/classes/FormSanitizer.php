<?php 
class FormSanitizer {
    public static function sanitize_form_string($input_text){
        $input_text = strip_tags($input_text);
        $input_text = str_replace(" ", "", $input_text);
        $input_text = strtolower($input_text);
        $input_text = ucfirst($input_text);
        return $input_text;
    }
    public static function sanitize_form_username($input_text){
        $input_text = strip_tags($input_text);
        $input_text = str_replace(" ", "", $input_text);
        return $input_text;
    }
    public static function sanitize_form_password($input_text){
        $input_text = strip_tags($input_text);
        return $input_text;
    }
    public static function sanitize_form_email($input_text){
        $input_text = strip_tags($input_text);
        $input_text = str_replace(" ", "", $input_text);
        return $input_text;
    }
}