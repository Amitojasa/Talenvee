<?php
// Check if image file is a actual image or fake image
$postId=mysqli_real_escape_string($conn,$_GET['pid']);
$lUserId=$_SESSION['userid'];
if(isset($_POST["submit"])) {
    
    $caption=mysqli_real_escape_string($conn,$_POST['caption']);
    $tags=mysqli_real_escape_string($conn,$_POST['tags']);
    $a1=array();
    $a1=explode("#",$tags);
    $a1=array_filter($a1, function($value) { return $value !== ''; });
    
    if(count($a1)>5){
        echo "you can upload only 5 tags";
        exit(0);
    }

    $tags=json_encode($a1);
    mysqli_query($conn,"update posts set tags='$tags', caption='$caption' where id=$postId") or die(error_page());
}
?>
<style>
.img-fluid{
    max-height:300px;
    width:auto;
    
}
.post{
    text-align:center;
}

</style>

<div class="container my-3">
            <?php

            $t="";
            $query=mysqli_query($conn,"select * from posts where id=$postId") or die(error_page());
            while($r=mysqli_fetch_assoc($query)){
            foreach(json_decode($r['tags'],True) as $i=>$ii){
                $t.="#".$ii;
            }

            ?>
            <div class="card">
                <div class="card-body">
                    <div class="post">
                        <?php if($r['imageSrc']!=""){ ?>
                            <img class="img-fluid" id="post-pic" src="<?php echo $r['imageSrc']; ?>"  alt="">
                        <?php } ?>
                        <?php if($r['videoSrc']!=""){ ?>
                            <video id="post-pic" class="img-fluid" controls>
                                <source src="<?php echo $r['videoSrc'];?>" type="video/mp4">
                            </video>
                        <?php } ?>
                    </div>
                </div>
            </div>
        
    <form method="post" enctype="multipart/form-data">
        <textarea name="caption" class="form-control my-3" id="caption" rows="5" placeholder="Enter some text"><?php echo $r['caption'];?></textarea>
        <textarea name="tags" class="form-control my-3" id="tags" rows="2" placeholder="Enter tags (maximum 5) separate tags with # (eg: #sports#football)" required><?php echo $t;?>
        </textarea>
        <input type="submit" value="Update Post" class="form-control btn btn-primary" name="submit" id="sub-btn">
        
    </form>
        <?php } ?>
</div>