<?php
require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"]) ){
    $query = $con->prepare("SELECT progress FROM video_progress WHERE username=:username AND video_id=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);

    $query->execute();
    echo $query->fetchColumn();


}else{
    echo "No data passed";
}