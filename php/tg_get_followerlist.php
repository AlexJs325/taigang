<?php
	$response = array();
	require_once 'tg_db_connect.php';
	$db = new DB_CONNECT();

	//$_GET['username'] = 'root';

	if(isset($_GET['username'])){
		$username = $_GET['username'];
		//echo 'username = '.$username;

		$user_id = mysql_query("select id from tg_user where username = '".$username."'") or die(mysql_error());

		$user_id = mysql_fetch_array($user_id);

		$result = mysql_query("select follower_id from tg_friend where follow_id = ".$user_id['id']." and status = 1") or die(mysql_error());

		if(mysql_num_rows($result) > 0){
			$response['follower'] = array();
			while($row = mysql_fetch_array($result)){
				$follower = array();
				$follower['follower_id'] = $row['follower_id'];

				array_push($response['follower'], $follower);
			}
			$response['success'] = 1;
			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$response['message'] = "No follower";
			echo json_encode($response);
		}

	}

?>