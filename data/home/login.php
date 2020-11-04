<?php

include_once("../../data/home/base.php");
$db = new database();

if(isset($_POST['action'])){
	$action = $_POST['action'];
}

if(isset($_POST['username'])){
	$username = $_POST['username'];
}

if(isset($_POST['password'])){
	$password = $_POST['password'];
}

if($action == "login"){
    $sql = "select user_id from user_tbl where username =:username and password =:password";
    $param = array(':username'=>$username,":password" => $password);
    echo $db->login($sql,$param);
}