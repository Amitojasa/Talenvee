<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (@$_SESSION['login']==false){
	    echo "<script>alert('Please Login');</script>";
		echo "<script>window.location.href='index.php';</script>";
	}
?>
<link rel="stylesheet" href="includes/css/profile.css">
<script src="includes/js/profile.js"></script>
<div class="container-fluid">
<?php 
    $lUserId=$_SESSION['userid'];
    $compId=mysqli_real_escape_string($conn,$_GET['id']);
?>
<?php 
    $query=mysqli_query($conn,"select *,now() as n from competition where id=$compId") or die(error_page());
    $rs=mysqli_fetch_assoc($query);
    $user1=$rs['user1'];
    $user2=$rs['user2'];
    $post1=$rs['post1'];
    $post2=$rs['post2'];
    $winner=$rs['winner'];
    $time=$rs['startTime'];
    $status=$rs['status'];
    $t2=$rs['n'];
    $dif=strtotime($t2)-strtotime($time);
    $result=0;
    $winPost=$rs['winPost'];
    if($status==1){
        if($dif/86400>1){
            global $winPost;
            $result=1;
            $quer1=mysqli_query($conn,"select id,rating from posts where id=$post1") or die(error_page());
            $rqs1=mysqli_fetch_assoc($quer1);
            $rating1=$rqs1['rating'];
            $quer2=mysqli_query($conn,"select id,rating from posts where id=$post2") or die(error_page());
            $rqs2=mysqli_fetch_assoc($quer2);
            $rating2=$rqs2['rating'];
            if($rating1 > $rating2){
                $winner=$user1;
                $winPost=$post1;
            }elseif($rating2 > $rating1){
                $winner=$user2;
                $winPost=$post2;
            }else{
                $querc1=mysqli_query($conn,"select count(*) as c from comments where postId=$post1") or die(error_page());
                $rqsc1=mysqli_fetch_assoc($querc1);
                $rating1=$rating1+$rqsc1['c'];

                $querc2=mysqli_query($conn,"select count(*) as c from comments where postId=$post2") or die(error_page());
                $rqsc1=mysqli_fetch_assoc($querc2);
                $rating2=$rating2+$rqsc1['c'];
                if($rating1 > $rating2){
                    $winner=$user1;
                    $winPost=$post1;
                }elseif($rating2 > $rating1){
                    $winner=$user2;
                    $winPost=$post2;
                }

            }

            mysqli_query($conn,"update competition set status=0,winner=$winner,winPost=$winPost  where id=$compId") or die(error_page());
            mysqli_query($conn,"update posts set type='general' where id in ($post1,$post2)") or die(error_page());
            echo "<div class='alert alert-danger my-2'>Competition is over and result is out</div>";
        }
    }else{
        echo "<div class='alert alert-danger my-2'>Competition is over and result is out</div>";
        $result=1;
    }
    
    

?>
<?php
        if($result==1){
            echo "<div class='alert alert-warning my-2'><a href='single.php?pid=".$winPost."'>View</a> the <strong>winning</strong> post is </div>";
        }
    ?>
    <div class="row">

    

        <div class="col-md-6">
                        <?php
                            
                            $query=mysqli_query($conn,"SELECT * FROM `posts` where id=$post1") or die(error_page());
                            while($r=mysqli_fetch_assoc($query)){
                                $pid=$r['id'];
                        ?>
                        <div class="card my-3">
                            <div class="card-header p-0 m-0">
                                <?php 
                                    $ai=$r['authorId'];
                                    $query1=mysqli_query($conn,"select * from userdetailstb where id=$ai");
                                    $rqs=mysqli_fetch_assoc($query1);
                                ?>
                                <a class="nav-link" href="profileshow.php?userName=<?php echo $rqs['username'];?>">
                                    <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $rqs['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $rqs['username']; ?>
                                </a>
                            </div>
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
                                <br>
                                <div class="captions">
                                    <?php echo $r['caption'];?>
                                </div>
                                <div class="tags my-2">
                                    <div id="post-tags">
                                        <?php 
                                        $tags=json_decode($r['tags']);
                                        foreach($tags as $i){ ?>
                                                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php echo $i;?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="icons">
                                    <div class="row">
                                        <div class="col-3 text-center" >
                                            <i id="likeThird<?php echo $pid;?>"  onclick='likeItThird(<?php echo $pid;?>);' class="<?php 
                                                $que=mysqli_query($conn,"select likes from posts where id=$pid") or die(error_page());
                                                $ar=json_decode(mysqli_fetch_assoc($que)['likes']);
                                                if(in_array($lUserId,$ar)){
                                                    echo "fas fa-thumbs-up";
                                                }else{
                                                    echo "far fa-thumbs-up";
                                                }
                                            ?>"></i>
                                            <a href="single.php?pid=<?php echo $pid;?>#showlikescomments"><small id="count-likesThird<?php echo $pid;?>" class="text-secondary count-likes"><?php echo count(json_decode($r['likes']));?></small></a>
                                        </div>
                                        
                                        <!-- <i class="fas fa-thumbs-up"></i> -->
                                        
                                        <div class="offset-1 col-3 text-center">
                                            <span class="copy-btn" data-type="attribute" data-attr-name="data-clipboard-text" data-model="couponCode" data-clipboard-text='http://talenvee.com/talent/single.php?pid=<?php echo $pid;?>'><i class="far fa-share-square"></i></span>
                                        </div>
                                        
                                        <!-- <i class="fas fa-share-square"></i> -->
                                        <div class="col-5">
                                            <small class="text-secondary" style="float: right;">Posted on <?php 
                                            $dt = new DateTime($r['uploadTime']);
                                            echo $dt->format('Y-m-d');?></small>
                                        </div>
                                    </div>
                                </div> 

                                    <div class="comments" id="commentsThird<?php echo $pid;?>">
                                                <div class="commenting" id="commentingThird<?php echo $pid;?>">
                                        <h6>Comments</h6>

                                        <form method="POST">
                                            <div class="row">
                                                <!-- <div class="col-sm-12"> -->
                                                <div class="col-sm-11">
                                                    <textarea class="mention form-control" id="commentValThird<?php echo $pid;?>" rows="1" placeholder="Add a comment" ></textarea>
                                                    </div>
                                                    <div class="col-sm-1 px-2">
                                                    <span class="btn btn-primary form-control" onclick="commentSubThird(<?php echo $pid;?>);"><i class="fa fa-paper-plane" aria-hidden="true"></i></span></div>
                                                
                                                <!-- </div> -->
                                            </div>
                                        </form>
                                        <?php
                                            $query1=mysqli_query($conn,"select * from comments where postId=$pid order by id desc limit 4") or die(error_page());
                                            $query1c=mysqli_query($conn,"select count(*) from comments where postId=$pid") or die(error_page());
                                            $rs1c=mysqli_fetch_assoc($query1c);
                                            while($rs=mysqli_fetch_assoc($query1)){
                                        ?>
                                            <div class="single-comment my-1">
                                                <?php
                                                    $ai=$rs['authorId'];
                                                    $q=mysqli_query($conn,"select * from userdetailstb where id=$ai") or die(error_page());
                                                    $pp=mysqli_fetch_assoc($q);
                                                ?>
                                                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $pp['profilepic'];?> " style="width:15px;height:15px;"><b><?php echo $pp['username'];?> : </b>
                                                    <p><?php echo getMentions($rs['comment']);?></p>
                                                <?php
                                                    if($rs['authorId']==$lUserId){
                                                        echo '<span onclick="removeCommentThird('.$rs['id'].','.$pid.');" style="float:right"><i class="fa fa-trash" aria-hidden="true"></i></span>';
                                                    }
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <a href="single.php?pid=<?php echo $pid;?>#showlikescomments">Show all <?php echo $rs1c['count(*)'];?> comments</a>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
        </div>
        <div class="col-md-6">
                        <?php
                        
                            $query=mysqli_query($conn,"SELECT * FROM `posts` where id=$post2") or die(error_page());
                            while($r=mysqli_fetch_assoc($query)){
                                $pid=$r['id'];
                        ?>
                        <div class="card my-3">
                            <div class="card-header p-0 m-0">
                                <?php 
                                    $ai=$r['authorId'];
                                    $query1=mysqli_query($conn,"select * from userdetailstb where id=$ai");
                                    $rqs=mysqli_fetch_assoc($query1);
                                ?>
                                <a class="nav-link" href="profileshow.php?userName=<?php echo $rqs['username'];?>">
                                    <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $rqs['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $rqs['username']; ?>
                                </a>
                            </div>
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
                                <br>
                                <div class="captions">
                                    <?php echo $r['caption'];?>
                                </div>
                                <div class="tags my-2">
                                    <div id="post-tags">
                                        <?php 
                                        $tags=json_decode($r['tags']);
                                        foreach($tags as $i){ ?>
                                                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php echo $i;?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="icons">
                                    <div class="row">
                                        <div class="col-3 text-center" >
                                            <i id="likeThird<?php echo $pid;?>"  onclick='likeItThird(<?php echo $pid;?>);' class="<?php 
                                                $que=mysqli_query($conn,"select likes from posts where id=$pid") or die(error_page());
                                                $ar=json_decode(mysqli_fetch_assoc($que)['likes']);
                                                if(in_array($lUserId,$ar)){
                                                    echo "fas fa-thumbs-up";
                                                }else{
                                                    echo "far fa-thumbs-up";
                                                }
                                            ?>"></i>
                                            <a href="single.php?pid=<?php echo $pid;?>#showlikescomments"><small id="count-likesThird<?php echo $pid;?>" class="text-secondary count-likes"><?php echo count(json_decode($r['likes']));?></small></a>
                                        </div>
                                        
                                        <!-- <i class="fas fa-thumbs-up"></i> -->
                                        
                                        <div class="offset-1 col-3 text-center">
                                            <span class="copy-btn" data-type="attribute" data-attr-name="data-clipboard-text" data-model="couponCode" data-clipboard-text='http://talenvee.com/talent/single.php?pid=<?php echo $pid;?>'><i class="far fa-share-square"></i></span>
                                        </div>
                                        
                                        <!-- <i class="fas fa-share-square"></i> -->
                                        <div class="col-5">
                                            <small class="text-secondary" style="float: right;">Posted on <?php 
                                            $dt = new DateTime($r['uploadTime']);
                                            echo $dt->format('Y-m-d');?></small>
                                        </div>
                                    </div>
                                </div> 

                                    <div class="comments" id="commentsThird<?php echo $pid;?>">
                                                <div class="commenting" id="commentingThird<?php echo $pid;?>">
                                        <h6>Comments</h6>

                                        <form method="POST">
                                            <div class="row">
                                                <!-- <div class="col-sm-12"> -->
                                                <div class="col-sm-11">
                                                    <textarea class="mention form-control" id="commentValThird<?php echo $pid;?>" rows="1" placeholder="Add a comment" ></textarea>
                                                    </div>
                                                    <div class="col-sm-1 px-2">
                                                    <span class="btn btn-primary form-control" onclick="commentSubThird(<?php echo $pid;?>);"><i class="fa fa-paper-plane" aria-hidden="true"></i></span></div>
                                                
                                                <!-- </div> -->
                                            </div>
                                        </form>
                                        <?php
                                            $query1=mysqli_query($conn,"select * from comments where postId=$pid order by id desc limit 4") or die(error_page());
                                            $query1c=mysqli_query($conn,"select count(*) from comments where postId=$pid") or die(error_page());
                                            $rs1c=mysqli_fetch_assoc($query1c);
                                            while($rs=mysqli_fetch_assoc($query1)){
                                        ?>
                                            <div class="single-comment my-1">
                                                <?php
                                                    $ai=$rs['authorId'];
                                                    $q=mysqli_query($conn,"select * from userdetailstb where id=$ai") or die(error_page());
                                                    $pp=mysqli_fetch_assoc($q);
                                                ?>
                                                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $pp['profilepic'];?> " style="width:15px;height:15px;"><b><?php echo $pp['username'];?> : </b>
                                                    <p><?php echo getMentions($rs['comment']);?></p>
                                                <?php
                                                    if($rs['authorId']==$lUserId){
                                                        echo '<span onclick="removeCommentThird('.$rs['id'].','.$pid.');" style="float:right"><i class="fa fa-trash" aria-hidden="true"></i></span>';
                                                    }
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <a href="single.php?pid=<?php echo $pid;?>#showlikescomments">Show all <?php echo $rs1c['count(*)'];?> comments</a>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
        </div>
    </div>
</div>
<script>
 $('textarea.mention').bind('input', function(e) { 
                    var ua = navigator.userAgent.toLowerCase(); 
                    var isAndroid = ua.indexOf('android') > -1;
                    //&& ua.indexOf(\'mobile\'); 
                    if(isAndroid) { 
                        var char = this.value.charCodeAt(this.value.length - 1); //$scope.data = char; 
                        if(e.keyCode === undefined){ 
                            e.keyCode = char; 
                        } 
                    return true; 
                    } 
                });

    $('textarea.mention').mentionsInput({
onDataRequest:function (mode, query, callback) {

$.getJSON('newTest/get_users_json.php', function(responseData) {
    responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
callback.call(this, responseData);
});
}
});

</script>  

