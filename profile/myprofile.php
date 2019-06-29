<link rel="stylesheet" href="includes/css/profile.css">
<link rel="stylesheet" href="includes/css/myprofile.css">
<script src="includes/js/profile.js"></script>

<?php
    $userId=$_SESSION['userid'];
    $lUserId=$userId;
    $que=mysqli_query($conn,"select * from userdetailstb where id='$userId'") or die(error_page());
    $ss=mysqli_fetch_assoc($que);
    $userName=$ss['username'];
    $interests=json_decode($ss['interests']);
?>

<div class="container my-3 mx-auto">
    <div class="row bg-light  text-center p-3" id="profile-header">
        <div class="col-sm-4" >
            <img id="profile-pic" src="profile/profile_pics/<?php echo $ss['profilepic'];?>" alt="" class="img-fluid rounded-circle border">
            <h5 class="my-2"><a id="profile-name" class="text-dark" href="profileshow.php?userName=<?php echo $ss['username'];?>"><?php echo $ss['username'];?></a></h5>
        </div>
        <div class="col-sm-8 my-auto">
            <div class="row">
                <div class="col-sm-4">
                    <h4>
                        <?php
                            $followingList=json_decode($ss['following']);
                            echo count($followingList);
                        ?>
                    </h4>
                    <a class="btn" href="myFollow.php?category=following"><div class="text-secondary">Following</div>  </a>
                </div>
                <div class="col-sm-4">
                    <h4>
                        <?php
                            $followerList=json_decode($ss['followers']);
                            echo count($followerList);
                        ?>
                    </h4>
                    <a class="btn" href="myFollow.php?category=followers"><div class="text-secondary">Followers</div></a>
                </div>
                <div class="col-sm-4">
                    <h4>
                        <?php
                            $postsList=json_decode($ss['posts']);
                            echo count($postsList);
                        ?>
                    </h4>
                    <span class="btn"><div class="text-secondary">Posts</div></span>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="offset-sm-5 col-sm-6  text-justify my-2">
                <?php echo $ss['UserDesc'];?>
            </div>
        </div>
    </div>
    <div class="row my-3 mx-auto">
        <div class="col-md-3">
            <div class="interests my-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="text-primary">Interests</h5>
                    </div>
                    <div id="interest-body" class="card-body">
                            <?php foreach($interests as $i){ ?>
                                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php echo $i;?></div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div><div id="showArea" class="col-md-8 border my-3 rounded">
        <div id="areaMain">
            <?php 
                $query=mysqli_query($conn,"select * from posts where authorId=$userId order by id desc") or die(error_page());
                while($r=mysqli_fetch_assoc($query)){
                    $pid=$r['id'];
            ?>
            <div class="card my-3">
                <div class="card-body">
                    <div class="dropdown dropleft text-right">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">+</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="deletePost(<?php echo $pid;?>);">Delete</a>
                        </div>
                    </div>
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
                                <i id="like<?php echo $pid;?>"  onclick='likeIt(<?php echo $pid;?>);' class="<?php 
                                    $que=mysqli_query($conn,"select likes from posts where id=$pid") or die(error_page());
                                    $ar=json_decode(mysqli_fetch_assoc($que)['likes']);
                                    if(in_array($lUserId,$ar)){
                                        echo "fas fa-thumbs-up";
                                    }else{
                                        echo "far fa-thumbs-up";
                                    }
                                ?>"></i>
                                <a href="single.php?pid=<?php echo $pid;?>#showlikescomments"><small id="count-likes<?php echo $pid;?>" class="text-secondary count-likes"><?php echo count(json_decode($r['likes']));?></small></a>
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

                        <div class="comments" id="comments<?php echo $pid;?>">
                                    <div class="commenting" id="commenting<?php echo $pid;?>">
                            <h6>Comments</h6>

                            <form method="POST">
                                <div class="row">
                                    <!-- <div class="col-sm-12"> -->
                                    <div class="col-sm-11">
                                                    <textarea  class="mention form-control" id="commentVal<?php echo $pid;?>" rows="1" placeholder="Add a comment" ></textarea>
                                                    </div>
                                                    <div class="col-sm-1 px-2">
                                                    <span class="btn btn-primary form-control" onclick="commentSub(<?php echo $pid;?>);"><i class="fa fa-paper-plane" aria-hidden="true"></i></span></div>
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
                                            echo '<span onclick="removeComment('.$rs['id'].','.$pid.');" style="float:right"><i class="fa fa-trash" aria-hidden="true"></i></span>';
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
        </div></div>
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