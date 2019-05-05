<?php

require_once "Config/Route.php";
require_once "Config/Config.php";

$request = $_SERVER['REQUEST_URI'];
$request = str_replace(ROOT,"",$request);

Redirect($request,$Route);

function Redirect($Request = null, $Route = array()){

    if(empty($Request) || empty($Route)){
        return ;
    }

    if(isset(parse_url($Request)['query'])){
        $query = parse_url($Request)['query'];
        $data = parse_str($query,$GET);
    }
    $path = parse_url($Request)['path'];

    if(isset($Route[$path])){
        require $Route[$path];
        return;
    }

    //header("Location: ".$Request);
    //die();
}

?>