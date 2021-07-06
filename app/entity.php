<?php
require_once("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No ID passed into page");
}

$entity_id = $_GET["id"];
$entity = new Entity($con, $entity_id);

$preview = new PreviewProvider($con, $user_logged);
echo $preview->create_preview_video($entity);

$season_provider = new SeasonProvider($con, $user_logged);
echo $season_provider->create($entity);

$category_container = new CategoriesContainers($con, $user_logged);
echo $category_container->show_category($entity->get_category_id(), "You might also like");