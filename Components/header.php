<?php
    include_once("Init.php"); 
    include_once("Core/LoginandRegister.php");
?>
<html>
<header>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</header>
<body>
<h1 class="h1">HOME PAGE</h1>

<h5 class="h5">PHOTOGRAPHY</h5>

<div class="menu">
    <ul>
        <li><a href="<?= BASE_URL ?>">Home Page</a></li>
        <?php
        if ((isset($_SESSION['username']) && $_SESSION['username'] != '')) {
            echo "<li>Hello: ".$_SESSION['username']."</li>";
            echo "<li><a href='".BASE_URL."photoUpload'>Photo</a></li>";
            echo "<li><a href='".BASE_URL."LogOut'>Logout</a>";
        }
        else {
            echo "<li><a href='".BASE_URL."SignIn'>Sign In</a>";
            echo "<li><a href='".BASE_URL."SignUp'>Sign Up</a>";

        }
        ?>
        <li>
            <form method="post" action="<?= BASE_URL ?>SearchImage">
                <input type="text" name="search" placeholder="Search for photos">
                <input type ="submit" value="Search" hidden >
            </form>
        </li>
    </ul>

</div>