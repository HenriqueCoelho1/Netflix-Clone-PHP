<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/Entity.php");

if(!isset($_SESSION["user_logged"])){
    header("Location: register.php");

}
$user_logged = $_SESSION["user_logged"];
$preview = new PreviewProvider($con, $user_logged);
echo $preview->create_preview_video(null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Hello World!</h1>
    
</body>
</html>