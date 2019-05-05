<?php
require_once "Config/Config.php";
require_once "Config/HuyDB.php";

$DB = new HuyDB();
$DB->Get_Connect();

session_start(); 
?>