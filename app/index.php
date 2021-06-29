<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $user_logged);
echo $preview->create_preview_video(null);
?>
