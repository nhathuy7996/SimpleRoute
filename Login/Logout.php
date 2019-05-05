<?php 

  include_once("Init.php");

  unset($_SESSION['username']);
  session_destroy();
  
  header("location: ".BASE_URL);
?>