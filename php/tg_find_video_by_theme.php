<?php

/**
 * Created by PhpStorm.
 * User: huanglong
 * Date: 14-10-28
 * Time: 下午10:09
 * function：通过主题的名称来查找视频信息
 */
$response = array();

require_once'tg_db_connect.php';
$db = new db_connect();
$_GET['theme_name'] = 'sports';

if(isset($_GET['theme_name']))
{
    $theme_name = $_GET['theme_name'];
    //乱码问题   暂时不支持中文查询
    $sql = "Select video_id,user_id,video_path,status,video_type,update_time,video_cover,video_theme,nickname,theme_name from tg_video as video,tg_theme as theme,tg_user as user where video.user_id = user.id and video.video_theme = theme.theme_id and theme.theme_name='{$theme_name}'";

    $result = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        // looping through all results
        // products node
        $response["videos"] = array();

        while ($row = mysql_fetch_array($result)) {
            // temp user array
            $video = array();
            $video["video_id"] = $row["video_id"];
            $video["user_id"] = $row["user_id"];
            $video["video_path"] = $row["video_path"];
            $video["status"] = $row["status"];
            $video["video_type"] = $row["video_type"];
            $video["update_time"] = $row["update_time"];
            $video["video_cover"] = $row["video_cover"];
            $video["nickname"] = $row["nickname"];
            $video["theme_name"] = $row["theme_name"];
            // push single video into final response array
            array_push($response["videos"], $video);
        }
        // success
        $response["success"] = 1;

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no products found
        $response["success"] = 0;
        $response["message"] = "No video found";

        // echo no users JSON
        echo json_encode($response);
    }
}else{
    $response['message'] = 'system error : cannot get theme name ';
    echo json_encode($response);
}
?>