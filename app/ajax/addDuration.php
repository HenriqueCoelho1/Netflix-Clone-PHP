<?php
require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"]) ){
    $query = $con->prepare("SELECT * FROM video_progress WHERE username=:username AND video_id=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);

    $query->execute();

    if($query->rowCount() === 0){
        $query = $con->prepare("INSERT INTO video_progress (username, video_id) VALUES (:username, :videoId)");
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->execute();

    }


}else{
    echo "No data passed";
}