<?php
/**
 * Created by PhpStorm.
 * User: huanglong
 * Date: 14-10-28
 * Time: 下午10:09
 * function：添加标签记录，标签和视频对应表（一个视频对应多个标签）
 */
$response = array();

require_once 'tg_db_connect.php';
$db = new db_connect();

$_GET['tag_id'] = 1;
$_GET['tag_name'] = "kobe";
$_GET['video_id'] = 1;


if(isset($_GET['tag_id'])&&isset($_GET['video_id'])&&isset($_GET['tag_name']))
{
    $tag_id = $_GET['tag_id'];
    $video_id = $_GET['tag_id'];
    $tag_name = $_GET['tag_name'];

    $sql = "Insert into tg_tag (tag_id,video_id,tag_name) values ('{$tag_id}','{$video_id}','{$tag_name}')";

    $result = mysql_query($sql) or die(mysql_error());
    if(!empty($result)){
        $response['success'] = 1;
        $response['message'] = 'add tag success';
        echo json_encode($response);
    }else{
        $response['success'] = 0;
        $response['message'] = 'add tag fail';
        echo json_encode($response);
    }

}


?>