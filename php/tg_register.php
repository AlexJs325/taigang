<?php
	$response = array();
    require_once 'tg_db_connect.php';
    $db = new DB_CONNECT();

    //Test Data
    // $_GET['username'] = "long2";
    // $_GET['password'] = "long3";
    // $_GET['gender'] = "1";
    // $_GET['nickname'] = "long2";
    // $_GET['email'] = "long2@long.com";

	if(isset($_GET['username']) && isset($_GET['password'])
		&& isset($_GET['gender']) && isset($_GET['nickname']) && isset($_GET['email']))
	{
		$username = $_GET['username'];
		$password = $_GET['password'];
		$gender = $_GET['gender'];
		$email = $_GET['email'];
		$nickname = $_GET['nickname'];
		$portrait = 0x1221;
		if (isset($_GET['portrait'])) {
			$portrait = $_GET['portrait'];
		}
		$reg_time = date('Y-m-d');
    	// connecting to db  
    	$result = mysql_query("insert into tg_user(username,password,nickname,email,gender,reg_time,portrait) values('{$username}','{$password}','{$nickname}','{$email}','{$gender}','{reg_time}','{portrait}')");
    	if(!empty($result)){
    		$response['success'] = 1;
    		$response['message'] = 'regist success';
    		echo json_encode($response);      
    	}else{
    		$response['success'] = 0;
    		$response['message'] = 'username already exisit';  
    		echo json_encode($response);  
    	}
	}else{
		$response['success'] = 0;
    	$response['message'] = 'please complete your information'; 
    	echo json_encode($response);  
	}
?>