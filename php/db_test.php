<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new DB_CONNECT();
	$_GET['user_id'] = 1;

	$user_id = $_GET['user_id'];

	$result = mysql_query("select 
	tg_video.video_name,count(tg_click.video_id) from tg_video ,tg_click where (tg_vid_id = ".$user_id.") and (tg_click.video_id = tg_video.eo.uservideo_id)");


	$result2 = mysql_query("select 
	tg_video.video_name,count(tg_challenge.be_video_id) from tg_video ,tg_challenge where (tg_video.user_id = ".$user_id.") and (tg_challenge.be_video_id = tg_video.video_id)");


	if(empty($result)&&empty($result2)){
		$response['error'] = 1;
		
		echo json_encode($response);

	}elseif(!empty($result)&&!empty($result2)){
		$result = mysql_fetch_array($result);
		$result2 = mysql_fetch_array($result2);
		$response['success'] = 1;
		$response['video_name'] = $result['video_name'];
		$response['click'] = $result[1];
		$response['challenge'] = $result2[1];

		echo json_encode($response);

	}elseif(!empty($result)){
		$result = mysql_fetch_array($result);
		$response['success'] = 1;
		$response['video_name'] = $result['video_name'];
		$response['click'] = $result[1];
		$response['challenge'] = 0;		

		echo json_encode($response);

	}else{
		$result2 = mysql_fetch_array($result2);
		$response['success'] = 1;
		$response['video_name'] = $result['video_name'];
		$response['click'] = 0;
		$response['challenge'] = $result2[1];

		echo json_encode($response);

	}


?>