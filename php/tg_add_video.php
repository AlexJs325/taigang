<?php
/**
 * Created by PhpStorm.
 * User: huanglong
 * Date: 14-10-29
 * Time: 上午9:34
 */
$response = array();

require_once 'tg_db_connect.php';
$db = new db_connect();

$_GET['video_name'] = "long test1";
$_GET['user_id'] = 3;
$_GET['video_path'] = "wait long 3";
$_GET['status'] = 1;
$_GET['video_type'] = 1;
$_GET['video_cover'] = "coverlong3";
$_GET['update_time'] = date('Y-m-d');
$_GET['video_theme'] = 1;


if(isset($_GET['video_name']) && isset($_GET['user_id']) && isset($_GET['status']) && isset($_GET['video_type']) && isset($_GET['update_time']) && isset($_GET['video_theme']))
{
    $video_name = $_GET['video_name'];
    $user_id = $_GET['user_id'];
    $video_path = $_GET['video_path'];
    $status = $_GET['status'];
    $video_type = $_GET['video_type'];
    $update_time = $_GET['update_time'];
    $video_cover = $_GET['video_cover'];
    $video_theme = $_GET['video_theme'];

    $sql = "Insert into tg_video (video_name,user_id,status,video_type,update_time,video_theme,video_path,video_cover) values('{$video_name}','{$user_id}','{$status}','{$video_type}','{$update_time}','{$video_theme}','{$video_path}','{$video_cover}')";
    $result = mysql_query($sql) or die(mysql_error());

    if(!empty($result)){
        $response['success'] = 1;
        $response['message'] = 'add video success';
        echo json_encode($response);
    }else{
        $response['success'] = 0;
        $response['message'] = 'add video fail';
        echo json_encode($response);
    }

}else{
    $response['success'] = 0;
    $response['message'] = "cannot get video information";
    echo json_encode($response);
}
