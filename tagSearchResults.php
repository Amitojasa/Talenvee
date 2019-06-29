<!-- <div class="tab-pane container fade" id="interestedTags"> -->
<link rel="stylesheet" href="includes/css/profile.css">
<link rel="stylesheet" href="includes/css/singlePost.css">
<script src="includes/js/profile.js"></script>
<div class="container">
<?php 
            $lUserId=$_SESSION['userid'];
            $userId=$lUserId;                 
            $i=mysqli_real_escape_string($conn,$_GET['tag']);   
                            $queryf=mysqli_query($conn,"select * from userdetailstb where id=$lUserId") or die(error_page());
                            $sqls="SELECT * FROM `posts` where tags like '%$i%' ";
                            
                            $query=mysqli_query($conn,$sqls." order by id desc") or die(error_page());
                            while($r=mysqli_fetch_assoc($query)){
                                $pid=$r['id'];
                        ?>
                        <div class="card my-3">
                            <div class="card-header p-0 m-0">
                                <?php 
                                    $ai=$r['authorId'];
                                    $query1=mysqli_query($conn,"select * from userdetailstb where id=$ai") or die(error_page());
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
                                            <i id="likeSec<?php echo $pid;?>"  onclick='likeItSec(<?php echo $pid;?>);' class="<?php 
                                                $que=mysqli_query($conn,"select likes from posts where id=$pid") or die(error_page());
                                                $ar=json_decode(mysqli_fetch_assoc($que)['likes']);
                                                if(in_array($lUserId,$ar)){
                                                    echo "fas fa-thumbs-up";
                                                }else{
                                                    echo "far fa-thumbs-up";
                                                }
                                            ?>"></i>
                                            <a href="single.php?pid=<?php echo $pid;?>#showlikescomments"><small id="count-likesSec<?php echo $pid;?>" class="text-secondary count-likes"><?php echo count(json_decode($r['likes']));?></small></a>
                                        </div>
                                        
                                        <!-- <i class="fas fa-thumbs-up"></i> -->
                                        
                                        <div class="offset-1 col-3 text-center">
                                            <span class="copy-btn" data-type="attribute" data-attr-name="data-clipboard-text" data-model="couponCode" data-clipboard-text='http://talenvee.com/single.php?pid=<?php echo $pid;?>'><i class="far fa-share-square"></i></span>
                                        </div>
                                        
                                        <!-- <i class="fas fa-share-square"></i> -->
                                        <div class="col-5">
                                            <small class="text-secondary" style="float: right;">Posted on <?php 
                                            $dt = new DateTime($r['uploadTime']);
                                            echo $dt->format('Y-m-d');?></small>
                                        </div>
                                    </div>
                                </div> 

                                    <div class="comments" id="commentsSec<?php echo $pid;?>">
                                                <div class="commenting" id="commentingSec<?php echo $pid;?>">
                                        <h6>Comments</h6>

                                        <form method="POST">
                                            <div class="row">
                                                <!-- <div class="col-sm-12"> -->
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" name="comment" id="commentValSec<?php echo $pid;?>" rows="1" placeholder="Add a comment"></textarea>
                                                    </div>
                                                    <div class="col-sm-1 px-2">
                                                    <span class="btn btn-primary form-control" onclick="commentSubSec(<?php echo $pid;?>);"><i class="fa fa-paper-plane" aria-hidden="true"></i></span></div>
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
                                                    <p><?php echo $rs['comment'];?></p>
                                                <?php
                                                    if($rs['authorId']==$lUserId){
                                                        echo '<span onclick="removeCommentSec('.$rs['id'].','.$pid.');" style="float:right"><i class="fa fa-trash" aria-hidden="true"></i></span>';
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