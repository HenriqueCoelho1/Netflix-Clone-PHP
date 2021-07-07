<?php
require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"]) && isset($_POST["progress"]) ){
    $query = $con->prepare("UPDATE video_progress SET progress=:progress WHERE username=:username AND video_id=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);
    $query->bindValue(":progress", $_POST["progress"]);

    $query->execute();


}else{
    echo "No data passed";
}