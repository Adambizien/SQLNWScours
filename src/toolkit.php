<?php
function dd( ...$params)
{
    foreach ($params as $param) {
        echo "<pre>";
        var_dump($param);
        echo "</pre>";
    }
    return;
}
function ddd( ...$params)
{
    echo "<pre>";
    var_dump($params);
    echo "</pre>";
    die();
}

function debugMode($active)
{
    if($active){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    return;
}

function fromInc($name){
    if(file_exists("./templates/includes/". $name . ".inc.php")){
        include "./templates/includes/". $name . ".inc.php";
    }else{
        return false;
    }
}
function fromstruc($name){
    if(file_exists("./templates/structure/". $name . ".struc.php")){
        include "./templates/structure/". $name . ".struc.php";
    }else{
        return false;
    }
}
function frompage($name){
    if(file_exists("./templates/page/". $name .".page.php")){
        include "./templates/page/" . $name .".page.php"; 
    }else{
        return false;
    }
}
function fromTool($name){
    if(file_exists("./templates/tools/". $name .".tool.php")){
        include "./templates/tools/" . $name .".tool.php"; 
    }else{
        return false;
    }
}


