<?php 
    //include_once( "Init.php");
    // Query statement
    //$query ="SELECT * FROM photos";

    // Get result & Get data
    //$photos = $DB->fetch_assoc($query);
    $l = Lang_Ctrl::Instant();
?>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</header>
<body>
<h1 class="h1"><?= $l->Trans("HOME PAGE") ?></h1>

<h5 class="h5">PHOTOGRAPHY</h5>

<div class="menu">
    <ul>
        <li><a href="<?= BASE_URL ?>">Home Page</a></li>
            <li><a href='#'>Sign In</a>
            <li><a href='#'>Sign Up</a>

        <li>
            <form method="post" action="">
                <input type="text" name="search" placeholder="Search for photos">
                <input type ="submit" value="Search" hidden >
            </form>
        </li>
    </ul>

</div>
<title>HOME PAGE</title>
<link rel="stylesheet" href="Asset/css/style.css">

    <div class="content">
        <?php //foreach($photos as $photo) : ?>
            <ul>
                <li>
                    <a href="#">
                        <img src="">
                    </a>
                </li>
            </ul>
        <?php //endforeach; ?>
    </div>


</body>
</html>
