<?php 
include("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No ID passed into page");
}

$video = new Video($con, $_GET["id"]);
$video->increment_views();
$upNextVideo = VideoProvider::get_up_next($con, $video);
?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->get_title(); ?></h1>
    </div>

    <div class="videoControls upNext">
        <button><i class="fas fa-redo"></i></button>
        <div class="upNextContainer">
            <h2>Up next: </h2>
            <h3><?php echo $upNextVideo->get_title(); ?></h3>
            <h3><?php echo $upNextVideo->get_season_and_episode(); ?></h3>
        </div>
    </div>
    <video controls autoplay>
        <source src="<?php echo $video->get_file_path();?>" type="video/mp4">
    </video>
</div>
<script>
    initVideo("<?php echo $video->get_id(); ?>", "<?php echo $user_logged;?>");
</script>