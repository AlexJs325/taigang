<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new DB_CONNECT();

	//$_GET['username'] = 'root';

	if(isset($_GET['username'])){
		$username = $_GET['username'];
		//echo 'username = '.$username;

		$user_id = mysql_query("select id from tg_user where username = '".$username."'");

		$user_id = mysql_fetch_array($user_id);


		

		$result = mysql_query("select video_name,video_intro,video_path,update_time,video_cover,video_theme from tg_video where user_id = ".$user_id['id']."") or die(msql_error());

		if(mysql_num_rows($result) > 0){
			$response['sent_video'] = array();
			while($row = mysql_fetch_array($result)){
				$video = array();
				$video['video_name'] = $row['video_name'];
				$video['video_intro'] = $row['video_intro'];
				$video['video_path'] = $row['video_path'];
				$video['update_time'] = $row['update_time'];
				$video['video_cover'] = $row['video_cover'];
				$video['video_theme'] = $row['video_theme'];

				array_push($response['sent_video'], $video);
			}
			$response['success'] = 1;
			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$response['message'] = "No video find";
			echo json_encode($response);
		}

	}

?>