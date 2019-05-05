<?php
include "../Components/header.php"
?>
<title>Photo Upload</title>
<link rel="stylesheet" href="../Asset/css/style.css">

<div class="photo">
    <fieldset>
        <legend>Change Photo's Info</legend>
        <div class="content">
            <ul>
                <li style="width: 250px; text-align: center">Name:</li>
                <li style="width: 900px"><input type="text" name="name"></li>
                <li style="width: 250px; text-align: center">Tag: </li>
                <li style="width: 900px"><input type="text" name="tag"></li>
                <li style="width: 50px"><input type="submit" name="add" value="ADD"></li>
                <li style="width: 250px; text-align: center">Description: </li>
                <li style="width: 900px"><textarea name="tag"></textarea></li>
                <li style="width: 250px; text-align: center">Image: </li>
                <li style="width: 900px"><input type="file" name="image"></li>
                <li style="width: 150px"><input type="submit" name="add" value="CREATE" class="create"></li>
            </ul>
        </div>
    </fieldset>
</div>

<?php
include "../Components/footer.php"
?>

</body>
</html>