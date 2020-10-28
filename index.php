<?php
//https://github.com/nhathuy7996/SimpleRoute
//version 1.5
/*
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});
*/
session_start(); 

require_once "Config/Route.php";
require_once "Config/Config.php";
require_once "Config/HuyDB.php";
require_once "Config/Lang_Ctrl.php";


$request = $_SERVER['REQUEST_URI'];
$request = str_replace(ROOT,"",$request);
$Data = array();


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

    if(!isset($Route[$path]) || empty($Route[$path])){
        echo "REQUEST ERROR!";
        return;
    }

    $list_check_obj = explode("/",$Route[$path]);
    if(CreateObject($list_check_obj) )
        return;
    
    echo "ROUTER ERROR!";

}

function CreateObject($list_str){
    $path = 'MVC/';
    $id_class = -1;
    for($i= 0; $i < count($list_str); $i++){
        $path .= $list_str[$i];

        if(file_exists($path.'.php')){
            require $path.'.php';
            $id_class = $i;
            break;
        }else{
            $path .= '/';
        }
    }

    $Is_oop = class_exists($list_str[$id_class]);
 
    if($Is_oop){
        $object = new $list_str[$id_class]();
        
        for($i = $id_class+1; $i < count($list_str); $i++ ){
            if(method_exists($object,$list_str[$i])){
                $object->{$list_str[$i]}();
            }else{
                echo "function ".$list_str[$i]. " doesn't exist";
            }
        }
    }else{
        for($i = $id_class+1; $i < count($list_str); $i++ ){
            if(function_exists($list_str[$i])){
                $list_str[$i]();
            }else{
                echo "function ".$list_str[$i]. " doesn't exist";
            }
        }
    } 

    return $id_class != -1 ? true : false;
}

function Load_View($path){
    include_once $path;
}

function T($text){
    return Lang_Ctrl::Instant()->Trans($text);
}

?>
