<?php


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    
    $caption=mysqli_real_escape_string($conn,$_POST['caption']);
    $target_dir = "createPost/uploads/";
    $tags=mysqli_real_escape_string($conn,$_POST['tags']);
    $a1=array();
    $a1=explode("#",$tags);
    $a1=array_filter($a1, function($value) { return $value !== ''; });
    
    if(count($a1)>5){
        echo "you can upload only 5 tags";
        exit;
    }
    $tags=json_encode($a1);
    if($_COOKIE['media']=='text'){
        mysqli_query($conn,"INSERT INTO `posts`(`caption`, `authorId`, `tags`) VALUES ('$caption',$uid,'$tags')") or die(error_page());
        $last_id=mysqli_query($conn,"select LAST_INSERT_ID()") or die(error_page());
		$last_id=mysqli_fetch_array($last_id);
		$pid=$last_id[0];
        $qp=mysqli_query($conn,"select posts from userdetailstb where id='$uid'") or die(error_page());
        $qr=mysqli_fetch_assoc($qp)['posts'];
        $fav=json_decode($qr);
        array_push($fav,$pid);
        $jsonCart = json_encode($fav);
        mysqli_query($conn,"update userdetailstb set posts='$jsonCart' where id='$uid'") or die(error_page());
        
        exit;
    }
    $target_file = $target_dir.time().'_'.basename($_FILES['fileToUpload']["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
// Allow certain file formats
if($_COOKIE['media']=="image"){
    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg"
    && $imageFileType != "gif"  && $imageFileType != "JPEG" 
    && $imageFileType != "GIF" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
}
//avi|mp3|mp4|mpeg|ogg
if($_COOKIE['media']=="video"){
    if($imageFileType != "avi" && $imageFileType != "mp4" && $imageFileType != "mpeg" && $imageFileType != "ogg" ) {
        echo "Sorry, only avi, mp4, mpeg & ogg files are allowed.";
        $uploadOk = 0;
    }else{
        $dur = mysqli_real_escape_string($conn,$_POST['f_du']);
        if($dur>120){
            echo "Sorry, only less than 120 sec(2 minutes) videos are allowed.";
            $uploadOk = 0;
        }
        else{
            $uploadOk=1;
        }
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $time = date('Y-m-d');
        if($_COOKIE['media']=='image'){
            mysqli_query($conn,"INSERT INTO `posts`(`imageSrc`, `caption`, `authorId`, `tags`) VALUES ('$target_file','$caption',$uid,'$tags')") or die(error_page());
        }elseif($_COOKIE['media']=='video'){
            mysqli_query($conn,"INSERT INTO `posts`(`videoSrc`, `caption`, `authorId`, `tags`) VALUES ('$target_file','$caption',$uid,'$tags')") or die(error_page());
        }
        $last_id=mysqli_query($conn,"select LAST_INSERT_ID()") or die(error_page());
		$last_id=mysqli_fetch_array($last_id);
		$pid=$last_id[0];
        $qp=mysqli_query($conn,"select posts from userdetailstb where id='$uid'") or die(error_page());
        $qr=mysqli_fetch_assoc($qp)['posts'];
        $fav=json_decode($qr);
        array_push($fav,$pid);
        $jsonCart = json_encode($fav);
        mysqli_query($conn,"update userdetailstb set posts='$jsonCart' where id='$uid'") or die(error_page());
        echo "The post  has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your post.";
    }
}
}
?>
<script>
function mediaTypes(){
    var a=document.getElementById('mediaType').value;
    if(a=="text"){
        document.getElementById('media').style.display="none";
        document.getElementById('sub-btn').removeAttribute('disabled');
        document.getElementById('caption').removeAttribute('disabled');
        document.getElementById('tags').removeAttribute('disabled');
        document.cookie = "media=text;path=/";
    }else if(a=="video"){
        document.getElementById('media').style.display="block";
        document.getElementById('fileToUpload').removeAttribute('disabled');
        document.getElementById('sub-btn').removeAttribute('disabled');
        document.getElementById('caption').removeAttribute('disabled');
        document.getElementById('tags').removeAttribute('disabled');
        document.cookie = "media=video;path=/";
    }else if(a=="image"){
        document.getElementById('media').style.display="block";
        document.getElementById('fileToUpload').removeAttribute('disabled');
        document.getElementById('sub-btn').removeAttribute('disabled');
        document.getElementById('caption').removeAttribute('disabled');
        document.getElementById('tags').removeAttribute('disabled');
        document.cookie = "media=image;path=/";
    }else if(a==""){
        document.cookie = "media=;path=/";
        document.getElementById('fileToUpload').setAttribute('disabled',"");
        document.getElementById('sub-btn').setAttribute('disabled',"");
        document.getElementById('caption').setAttribute('disabled',"");
        document.getElementById('tags').setAttribute('disabled',"");
    }
}
</script>
<div class="container my-3">
    <form method="post" enctype="multipart/form-data">
        <select name="mediaType" id="mediaType" class="form-control" onchange='mediaTypes();'>
            <option value="">Select Media type</option>
            <option value="video">Video</option>
            <option value="image">Image</option>
            <option value="text">Text-Only</option>
        </select><br>
        <div id="media">
        <h5>Select media to upload:</h5>
            <input class="form-control my-2" type="file" name="fileToUpload" id="fileToUpload" disabled>
            <input type='text' class="form-control" name='f_du' id='f_du' size='5' hidden>
        </div>
        <textarea name="caption" class="form-control my-3" id="caption" rows="5" placeholder="Enter some text" disabled></textarea>
        <textarea name="tags" class="form-control my-3" id="tags" rows="2" placeholder="Enter tags (maximum 5) separate tags with # (eg: #sports#football)" disabled required></textarea>
        <input type="submit" value="Upload Post" class="form-control btn btn-primary" name="submit" id="sub-btn" disabled>
        
    </form>
    <audio id='audio'></audio>

</div>

<script>

var f_duration =0; //store duration
document.getElementById('audio').addEventListener('canplaythrough', function(e){
 f_duration = Math.round(e.currentTarget.duration);
 document.getElementById('f_du').value = f_duration;
 URL.revokeObjectURL(obUrl);
});

//when select a file, create an ObjectURL with the file and add it in the #audio element
var obUrl;
document.getElementById('fileToUpload').addEventListener('change', function(e){
 var file = e.currentTarget.files[0];
 //check file extension for audio/video type
 if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
 obUrl = URL.createObjectURL(file);
 document.getElementById('audio').setAttribute('src', obUrl);
 }
});



</script>