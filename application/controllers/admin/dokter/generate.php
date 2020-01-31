<?php
error_reporting( E_ALL );
    $video = "http://namagz.blog/tugasakhir/upload/laporan/".$_GET['nama'].".".$_GET['format'];
    $thumbnail = $_GET['nama'].".jpg";

// shell command [highly simplified, please don't run it plain on your script!]
    //echo $video."<br>";
    //echo $thumbnail;
    
    $myObj->status = 1;
    $myObj->video = $video;
    $myObj->message = "berhasil";
    $myObj->asd = "ffmpeg -i ".$video." -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail."  2>&1";
    $myObj->link_thumbnail = "http://101.50.3.229/generate/".$_GET['nama'].".jpg";
    
    $myJSON = json_encode($myObj,JSON_PRETTY_PRINT);
    header('Content-Type: application/json');

    echo $myJSON;
    shell_exec("ffmpeg -i ".$video." -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail."  2>&1");
    
?>
