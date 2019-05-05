<?php
    include_once("Init.php");
    include_once("Core/Photos.php");
    include_once("Components/header.php");
?>
<title>Photo Upload</title>
<link rel="stylesheet" href="Asset/css/style.css">
<div class="photo">
    <fieldset>
        <legend>Create Photo</legend>
        <div class="content">
                <ul>
                    <form action="photoUpload.php" class="photoForm" method="post" enctype="multipart/form-data">
                        <li style="width: 250px; text-align: center">Name:</li>
                        <li style="width: 900px"><input type="text" name="photo_name" placeholder="Photo name" required></li>
                        <li style="width: 250px; text-align: center">Tag: </li>
                        <li style="width: 900px"><input type="text" name="photo_tag" placeholder="Each tag seperate by a whitespace" required></li>
                        <li style="width: 250px; text-align: center">Description: </li>
                        <li style="width: 900px"><textarea name="photo_description" required></textarea></li>
                        <li style="width: 250px; text-align: center">Image: </li>
                        <li style="width: 900px"><input type="file" name="image"></li>
                        <li style="width: 150px"><input type="submit" name="addPhoto" value="CREATE" class="create"></li>
                    <form>
                </ul>
            </form>
        </div>
    </fieldset>
</div>


<!-- <div class="photo">
    <h3>
        Username
    </h3>
    <h5 class="name">
        <i class="far fa-calendar-times"></i>
        Datetime
    </h5>
    <div class="content" style=" padding: 0">
        <ul style="padding: 0; margin: 0">
            <li style="margin: 0">
                <img src="../Asset/image/avatar">
            </li>
            <li style="width: 940px; padding: 0 20px">
                DESCRIPTION
            </li>
        </ul>
        <a class="link" href="../Profile/fixPhoto.php"><i class="fas fa-tools"></i></a>
    </div>
</div> -->

<?php
    include "Components/footer.php"
?>

</body>
</html>