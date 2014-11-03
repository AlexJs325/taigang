<?php
/**
 * Created by PhpStorm.
 * User: huanglong
 * Date: 14-10-28
 * Time: 下午4:05
 * function:根据video_id查找视频的相关信息
 */
    $response = array();

    require_once'tg_db_connect.php';
    $db = new db_connect();
    $_GET['video_id'] = 6;


    if(isset($_GET['video_id']))
    {
        $video_id = $_GET['video_id'];
        $sql = "Select video_id,user_id,video_path,status,video_type,update_time,video_cover,nickname,theme_name from tg_video as video ,tg_theme as theme,tg_user as user where video.user_id = user.id and video.video_theme = theme.theme_id and video.video_id ='{$video_id}'";

        $result = mysql_query($sql);
        if (!empty($result)) {
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
            
            $response["success"] = 0;
            $response["message"] = "No video found";

            // echo no users JSON
            echo json_encode($response);
        }
}else{
    $response['success'] = 0;
    $response['message'] = 'cannot get video id';
    echo json_encode($response);
}
?>