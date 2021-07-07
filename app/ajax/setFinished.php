<?php
require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"]) ){
    $query = $con->prepare("UPDATE video_progress SET finished=1, progress=0 WHERE username=:username AND video_id=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);

    $query->execute();


}else{
    echo "No data passed";
}