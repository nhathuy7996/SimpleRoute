<?php

require_once "Config/Route.php";
require_once "Config/Config.php";

$request = $_SERVER['REQUEST_URI'];
$request = str_replace(ROOT,"",$request);
$data = array();

Redirect($request,$Route);

function Redirect($Request = null, $Route = array()){

    if(empty($Request) || empty($Route)){
        return ;
    }

    if(isset(parse_url($Request)['query'])){
        $query = parse_url($Request)['query'];
        $data_request = parse_str($query,$GET);
    }
    $path = parse_url($Request)['path'];

    if(isset($Route[$path])){
        $l = explode("|", $Route[$path]);
        require "$l[0]".".php";

        if(count($l) > 1){
            $className = explode("/",$l[0]);
            $len = count($className);

            $object = new $className[$len-1]();
            $object->{$l[1]}();
        }
        return;
    }

    //header("Location: ".$Request);
    //die();
}

?>
