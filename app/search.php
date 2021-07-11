<?php
require_once("includes/header.php");
?>

<div class="textBoxContainer">
    <input type="text" class="searchInput" placeholder="Search for something" />
</div>

<div class="results">

</div>

<script>
$(function () {
    const username = '<?php echo $user_logged; ?>';
    let timer;

    $(".searchInput").keyup(function() {
        clearTimeout(timer)

        timer = setTimeout(function() {
            const val = $(".searchInput").val()
            if(val !== ""){
                $.post("ajax/getSearchResults.php", {term: val, username}, function(data){
                    $(".results").html(data)
                })
            }else{
                $(".results").html("")
            }
        }, 500)
    })
}) 
</script>