<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new DB_CONNECT();

//	$_GET['username'] = 'js';

	if(isset($_GET['username'])){
		$username = $_GET['username'];
		//echo 'username = '.$username;

		$user_id = mysql_query("select id from tg_user where username = '".$username."'") or die(mysql_error());

		$user_id = mysql_fetch_array($user_id);

		$result = mysql_query("select follow_id from tg_friend where follower_id = ".$user_id['id']." and status = 1") or die(mysql_error());

		if(mysql_num_rows($result) > 0){
			$response['follow'] = array();
			while($row = mysql_fetch_array($result)){
				$follow = array();
				$follow['follow_id'] = $row['follow_id'];

				array_push($response['follow'], $follow);
			}
			$response['success'] = 1;
			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$response['message'] = "No follow";
			echo json_encode($response);
		}

	}

?>