<?php 
$target_dir = "test_upload/";
 
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$filename=$_FILES["fileToUpload"]["name"];

 
    include_once('../getID3/getid3/getid3.php');
    $getID3 = new getID3;
    $file = $getID3->analyze($filename);
    echo("Duration: ".$file['playtime_string'].
    " / Dimensions: ".$file['video']['resolution_x']." wide by ".$file['video']['resolution_y']." tall"." / Filesize: ".$file['filesize']." bytes<br />");
?>