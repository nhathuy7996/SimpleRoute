<?php 
    include_once("Components/header.php"); 
    include_once( "Init.php");

    // Get id
    $photo_id = $DB->Security( $_GET["id"]);

    // Query statement
    $getPhotoquery = "SELECT * FROM photos WHERE photo_id='".$photo_id."'";
    $getTagQuery = "SELECT tag_name FROM tags INNER JOIN tag_photo ON tags.tag_id = tag_photo.tag_id WHERE photo_id ='".$photo_id."'";
    $getPhotoAuthorQuery = "SELECT user_name from users INNER JOIN photos ON users.user_id = photos.user_id WHERE photo_id='".$photo_id."'";
  
    // Fetch data
    $photo = $DB->fetch_assoc($getPhotoquery,1);
    $tags = $DB->fetch_assoc($getTagQuery);
    $author = $DB->fetch_assoc($getPhotoAuthorQuery,1);
    // var_dump($photo);

?>
<title>Single Photo</title>
<link rel="stylesheet" href="Asset/css/style.css">

    <div class="contentSingle">
        <img src="<?= BASE_URL.$photo["photo_dir"]; ?>">
        <br>
        <h3 style="display:inline"><?= $photo["photo_title"] ?></h3>
        <br>
        <h4 style="display:inline">By <?=$author["user_name"]; ?></h4>
        <br>
        <p style="display:inline"><?= $photo["photo_description"]; ?></p>
        <br>
        <h5 style="display:inline">Tag: <?php foreach($tags as $tag){
                echo $tag["tag_name"].", ";
            } ?>
        </h5>
    </div>

<?php
    include_once("Components/footer.php");
?>
</body>
</html>
