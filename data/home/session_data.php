<?php


if(isset($_POST['action'])){
    $action = $_POST['action'];
}

if(isset($_POST['user'])){
    $user = $_POST['user'];
}

if($action == "create"){
    session_start();
    $_SESSION["user"] = $user;
    echo "session created";
}

if($action == "retrieve"){
    session_start();
    echo $_SESSION["user"];
   
}

if($action == "out"){
    session_start();
    session_destroy();
    echo "session destroyed";
}

