<?php
//require_once("vendor/autoload.php"); 
include_once("lib/config.php");


function autoloadLibrary($className){
    $filename = "lib/".$className.".php";
    if(is_readable($filename)){
        require $filename;
    }
}

function autoloadController($className){
    $filename = "controller/".$className.".php";
    if(is_readable($filename)){
        require $filename;
    }
}

function autoloadModel($className){
    $filename = "model/".$className.".php";
    if(is_readable($filename)){
        require $filename;
    }
}

spl_autoload_register("autoloadLibrary");
spl_autoload_register("autoloadController");
spl_autoload_register("autoloadModel");

$app = new App();

$app->init();
