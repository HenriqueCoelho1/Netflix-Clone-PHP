<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $user_logged);
echo $preview->create_movies_preview_video();

$containers = new CategoriesContainers($con, $user_logged);
echo $containers->show_tv_show_categories();
?>
