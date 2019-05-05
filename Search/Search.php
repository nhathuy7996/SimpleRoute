<?php
include_once("Init.php");
include_once("Components/header.php");

if(isset($_POST['search'])){
    $key = $_POST['search'];
    $sql= "SELECT * FROM photos WHERE photo_title LIKE '%$key%' OR photo_description LIKE '%$key%' ";
    $searchByTitle = $DB->fetch_assoc($sql);


    $sql = "SELECT tag_id FROM tags WHERE tag_name LIKE '%$key%'";
    $tagID = $DB->fetch_assoc($sql);
    
    if(!empty($tagID)){
        $photos = array();
        foreach($tagID as $t){
            $id =$t['tag_id'];
            $sql = "SELECT photo_id FROM tag_photo WHERE tag_id = $id ";
            $photo_id = $DB->fetch_assoc($sql);
            
            foreach($photo_id as $a){
                $photoID = $a['photo_id'];
                $sql = "SELECT * FROM photos WHERE photo_id = $photoID";
                $photo = $DB->fetch_assoc($sql,1);
   
                if(!empty($photo))
                    array_push($photos,$photo);
            }
        }

        $photos = array_diff($photos,$searchByTitle);
    }

    

}



?>
<title>Search</title>
<link rel="stylesheet" href="Asset/css/style.css">

<div class="content">
        <?php if(!empty($searchByTitle)) foreach($searchByTitle as $photo) : ?>
            <ul>
                <li>
                    <a href="<?= BASE_URL ?>singlePhoto?id=<?= $photo['photo_id'] ?>">
                        <img src="<?= BASE_URL.$photo['photo_dir']; ?>">
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>
        <?php if(!empty($photos))  foreach($photos as $photo) : ?>
            <ul>
                <li>
                    <a href="<?= BASE_URL ?>singlePhoto?id=<?= $photo['photo_id'] ?>">
                        <img src="<?= BASE_URL.$photo['photo_dir']; ?>">
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>
        <?php if(empty($searchByTitle) && empty($photos)) echo "<h2>No Result</h2>" ?>
    </div>

<?php
    include_once("Components/footer.php");
?>
</body>
</html>