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

		$result = mysql_query("select nickname,email,gender,reg_time,portrait from tg_user where id = ".$user_id['id']."");

		if(!empty($result)&&mysql_num_rows($result)>0){
			$result = mysql_fetch_array($result);
			$response['success'] = 1;
			$response['nickname'] = $result['nickname'];
			$response['email'] = $result['email'];
			$response['gender'] = $result['gender'];
			$response['reg_time'] = $result['reg_time'];
			$response['portrait'] = $result['portrait'];

			echo json_encode($response);
		}else{
			$response['success'] = 0;
			$response['message'] = "cannot find the user";
			echo json_encode($response);
		}
	}else{
		$response['success'] = 0;
		$response['message'] = "system error";
	}
?>