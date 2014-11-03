<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new db_connect();

	$_GET['video_id'] = 1;
	$_GET['user_id'] = 3; 

	if(isset($_GET['video_id'])&&isset($_GET['user_id'])){
		$video_id = $_GET['video_id'];
		$user_id = $_GET['user_id'];
		$click_time = date('Y-m-d H:i:s');
		$query = "insert into tg_click(video_id,user_id,click_time) values('{$video_id}','{$user_id}','{$click_time}')";

		$result = mysql_query($query);
		if(!empty($result)&&mysql_affected_rows()>0){
			$response['success'] = 1;
			$result2 = mysql_query("select count(click_id) from tg_click where video_id = '{$video_id}'");
			$result2 = mysql_fetch_array($result2);
			$response['clickzan'] = $result2[0]; 
			$response['message'] = "success click zan";

			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$result2 = mysql_query("select count(click_id) from tg_click where video_id = '{$video_id}'");
			$result2 = mysql_fetch_array($result2);
			$response['clickzan'] = $result2[0]; 
			$response['message'] = "fail to click zan";

			echo json_encode($response);
		}

	}else{
		$response['success'] = 0;
		$response['message'] = "system error";
		echo json_encode($response);
	}
?>