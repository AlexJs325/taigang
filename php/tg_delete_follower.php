<?php
$response = array();
require_once 'tg_db_connect.php';
$db = new db_connect();

$_GET['follow_id'] = 1;
$_GET['follower_id'] = 2;

if(isset($_GET['follow_id'])&&isset($_GET['follower_id'])){
	$follow_id = $_GET['follow_id'];
	$follower_id = $_GET['follower_id'];

	$result = mysql_query("update tg_friend set status = 0 where follow_id = '{$follow_id}' and follower_id = '{$follower_id}'") or die(mysql_error());
	if(!empty($result)&&mysql_affected_rows()>0){

		$response['success'] = 1;
		$response['message'] = "delete follewer success";
		echo json_encode($response);
	}else{
		$response['success'] = 0;
		$response['message'] = "delete follower fail";
		echo json_encode($response);
	}
}else{
	$response['success'] = 0;
	$response['message'] = "system error";
	echo json_encode($response);
}

?>