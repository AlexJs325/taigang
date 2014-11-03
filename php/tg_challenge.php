<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new db_connect();

	$_GET['be_video_id'] = 1;
	$_GET['video_id'] = 7;

	if(isset($_GET['be_video_id'])&&isset($_GET['video_id'])){
		$be_video_id = $_GET['be_video_id'];
		$video_id = $_GET['video_id'];
		$challenge_time = date("Y-m-d H:i:s");


		$query = "insert into tg_challenge(be_video_id,video_id,challenge_time) values('{$be_video_id}','{$video_id}','{$challenge_time}')";

		$result = mysql_query($query);

		if(!empty($result)&&mysql_affected_rows()>0){
			$response['success'] = 1;
			$result2 = mysql_query("select count(challenge_id) from tg_challenge where be_video_id = '{$be_video_id}'");
			$result2 = mysql_fetch_array($result2);
			$response['challenge'] = $result2[0];
			$response['message'] = "challenge success";

			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$result2 = mysql_query("select count(challenge) from tg_challenge where video_id = '{$be_video_id}'");
			$result2 = mysql_fetch_array($result2);
			$response['challenge'] = $result2[0];
			$response['message'] = "challenge fail";

			echo json_encode($response);

		}
	}else{
		$response['success'] = 0;
		$response['message'] = "system error";
	}
?>