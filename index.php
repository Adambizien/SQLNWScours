<?php

require_once './configs/bootstrap.php';
require_once './src/toolkit.php';
ob_start();

if(isset($_GET["page"]) ){
    if(frompage($_GET['page']) === false){
        header('Location: ./?page=accueil&layout=html');
    };
}else{
    header('Location: ./?page=accueil&layout=html');
    exit;
}

$pageContent = [
    "html" => ob_get_clean(),
];

if(isset($_GET["layout"])){
    include "./templates/layouts/". $_GET["layout"] .".layout.php";

}else{
    include "./templates/layouts/html.layout.php";
}
