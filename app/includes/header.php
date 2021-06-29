<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/Entity.php");

if(!isset($_SESSION["user_logged"])){
    header("Location: register.php");

}
$user_logged = $_SESSION["user_logged"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <link rel="stylesheet" href="assets/style/style.css" />
    <script src="https://kit.fontawesome.com/14194bdf96.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">