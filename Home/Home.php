<?php 
    include_once( "Init.php");
    include_once("Components/header.php");
    // Query statement
    $query ="SELECT * FROM photos";

    // Get result & Get data
    $photos = $DB->fetch_assoc($query);

?>
<title>HOME PAGE</title>
<link rel="stylesheet" href="Asset/css/style.css">

    <div class="content">
        <?php foreach($photos as $photo) : ?>
            <ul>
                <li>
                    <a href="<?= BASE_URL ?>singlePhoto?id=<?= $photo['photo_id'] ?>">
                        <img src="<?= BASE_URL.$photo['photo_dir']; ?>">
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>

<?php
    include "Components/footer.php"
?>
</body>
</html>
