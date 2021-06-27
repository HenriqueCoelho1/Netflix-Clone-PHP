<?php
ob_start();
session_start();

date_default_timezone_set("America/Sao_Paulo");

try{
    $con = new PDO("mysql:dbname=db_netflix;host=db_netflix_clone", "user", "123456");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
}catch(PDOExeception $e){
    exit("Connection failed: " . $e->getMessage());


}