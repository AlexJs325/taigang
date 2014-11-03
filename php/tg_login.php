<?php
	$response = array();//返回数据
	require_once 'tg_db_connect.php';
    $db = new DB_CONNECT();

	if (isset($_GET['username']) && isset($_GET['password'])) {
		$username = $_GET['username'];
		$password = $_GET['password'];
        echo 'username = '.$username;
        echo 'password = '.$password;

		$result = mysql_query("select password from tg_user where username='".$username."'");
		if (!empty($result) && mysql_num_rows($result) > 0) {
			$result = mysql_fetch_array($result);
			if($result['password'] == $password){
				$response['success'] = 1;
				$response['message'] = '验证登陆成功111';
				echo json_encode($response);
			}else{
				$response['success'] = 0;
				$response['message'] = '密码不正确222';
				echo json_encode($response);
			}
		}else{
			$response['success'] = 0;
			$response['message'] = '用户不存在333';
			echo json_encode($response);
		}
	}else{
		$response['success'] = 0;
		$response['message'] = '没有输入用户名或密码444';
		echo json_encode($response);
	}
?>