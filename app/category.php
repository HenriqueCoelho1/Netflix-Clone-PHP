<?php
require_once("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No id passed to page");
}

$preview = new PreviewProvider($con, $user_logged);
echo $preview->create_category_preview_video($_GET["id"]);

$containers = new CategoriesContainers($con, $user_logged);
echo $containers->show_category($_GET["id"]);
?>
