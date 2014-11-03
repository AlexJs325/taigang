<?php
/**
 * Created by PhpStorm.
 * User: huanglong
 * Date: 14-10-29
 * Time: 下午12:33
 */
$response = array();

require_once 'tg_db_connect.php';
$db = new DB_CONNECT();

$_GET['follow_id'] = 2;
$_GET['follower_id'] = 1;

if(isset($_GET['follow_id']) && isset($_GET['follower_id']))
{
    $follow_id = $_GET['follow_id'];
    $follower_id = $_GET['follower_id'];
    $status = 1;

    $sql = "Insert into tg_friend (follow_id,follower_id,status) values('{$follow_id}','{$follower_id}','{$status}')";
    $result = mysql_query($sql) or die(mysql_error());
    if(!empty($result)){
        $response['success'] = 1;
        $response['message'] = 'add friend success';
        echo json_encode($response);
    }else{
        $response['success'] = 0;
        $response['message'] = 'add friend fail';
        echo json_encode($response);
    }

}else{
    $response['success'] = 0;
    $response['message'] = "cannot get user information";
    echo json_encode($response);
}
