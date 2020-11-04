<?php

include_once("../../data/home/base.php");
$db = new database();


if(isset($_POST['review_id'])){
	$id = $_POST['review_id'];
}

if(isset($_POST['action'])){
	$action = $_POST['action'];
}

if(isset($_POST['question'])){
	$question = $_POST['question'];
}

if(isset($_POST['answer'])){
	$answer = $_POST['answer'];
}
if(isset($_POST['choicea'])){
	$choicea = $_POST['choicea'];
}
if(isset($_POST['choiceb'])){
	$choiceb = $_POST['choiceb'];
}
if(isset($_POST['choicec'])){
	$choicec = $_POST['choicec'];
}
if(isset($_POST['minute'])){
	$minute = $_POST['minute'];
}
if(isset($_POST['category'])){
	$category = $_POST['category'];
}

if(isset($_POST['displayCategory'])){
	$displayCategory = $_POST['displayCategory'];
}

if($action == "insert"){

	$sql = "INSERT INTO `review_tbl`(`review_question`, `review_answer`, 
	`review_choicea`, `review_choiceb`, `review_choicec`, `review_time`,review_category) VALUES (:question,:answer,:choicea,:choiceb,:choicec,:minute,:category)";
	$param = array(':question' =>$question,':answer' =>$answer,':choicea' =>$choicea,':choiceb' =>$choiceb,':choicec' =>$choicec,':minute' =>$minute,':category' =>$category);
	$db->insert($sql,$param);
	
	echo $task.":".$remarks;
}

if($action == "getData"){
	if($displayCategory == "All"){
		$sql = "select * from review_tbl order by rand();";
	}else{
		$sql = "select * from review_tbl where review_category = '".$displayCategory."' order by rand();";
	}
	
	$data = $db->getValue($sql);
	echo json_encode($data);
}

if($action == "delete"){
	echo $db->deleteData($id);
}

if($action == "edit"){
	$sql = "select * from review_tbl WHERE myelination_id=".$id.";";
	$data = $db->getValue($sql);
	echo json_encode($data);
}






if($action == "display"){
	$db->display("select * from review_tbl"); 
}

if($action == "sample"){
	echo json_encode(array('sample data'));
}





