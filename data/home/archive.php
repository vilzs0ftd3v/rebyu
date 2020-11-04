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

if(isset($_POST['archive_id'])){
	$archive_id = $_POST['archive_id'];
}

if(isset($_POST['archive_name'])){
	$archive_name = $_POST['archive_name'];
}

if(isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];
}


if($action == "insert"){

	$sql = "INSERT INTO `review_tbl`(`review_question`, `review_answer`, 
	`review_choicea`, `review_choiceb`, `review_choicec`, `review_time`,archive_id
    ) VALUES (:question,:answer,:choicea,:choiceb,:choicec,:minute,:archive_id)";
	$param = array(':question' =>$question,':answer' =>$answer,':choicea' =>$choicea,':choiceb' =>$choiceb,':choicec' =>$choicec,':minute' =>$minute,':archive_id' =>$archive_id);
	$db->insert($sql,$param);
	
	echo $task.":".$remarks;
}

if($action == "create"){
	$sql = "INSERT INTO `archive_tbl`(`archive_name`,`user_id`,`date_added`) VALUES (:archive_name,:users_id,now())";
	$param = array(':archive_name' =>$archive_name,':users_id' =>$user_id);
	$db->insert($sql,$param);
}


if($action == "display"){
        $sql = "select count(r.archive_id) as 'count', a.archive_name,a.date_added,a.archive_id from archive_tbl a LEFT join review_tbl r on a.archive_id = r.archive_id GROUP by a.archive_id";
        $data = $db->getValue($sql); 
	 
	   echo json_encode($data);
}



if($action == "getData"){
	$sql="select * from review_tbl where archive_id=:archive_id order by rand()";
	//$sql="select * from review_tbl";
	$param = array(':archive_id' => $archive_id);
	$data = $db->getQuestions($sql,$param); 
 
   echo json_encode($data);
}

