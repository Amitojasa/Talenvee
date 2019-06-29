<link rel="stylesheet" href="includes/css/profile.css">
<script src="includes/js/profile.js"></script>

<?php
    $userName=mysqli_real_escape_string($conn,$_GET['userName']);
    $query=mysqli_query($conn,"select * from userdetailstb where username='$userName'") or die(error_page());
    $ss=mysqli_fetch_assoc($query);
    $userId=$ss['id'];
    
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
                    <a class="btn" href="showFollow.php?category=following&userName=<?php echo $userName;?>"><div class="text-secondary">Following</div>  </a>
                </div>
                <div class="col-sm-4">
                    <h4>
                        <?php
                            $followerList=json_decode($ss['followers']);
                            echo count($followerList);
                        ?>
                    </h4>
                    <a class="btn" href="showFollow.php?category=followers&userName=<?php echo $userName;?>"><div class="text-secondary">Followers</div></a>
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
        <div class="col-sm-12 my-3">
            <div class="row">
                <div class=" offset-sm-3 col-sm-6  text-justify my-2">
                    <?php echo $ss['UserDesc'];?>
                </div>
                <div class="col-sm-1 text-center my-2">
                    
                    <?php 
                        $lUserId=$_SESSION['userid'];
                        
                        $que=mysqli_query($conn,"select following from userdetailstb where id='$lUserId'") or die(error_page());
                        $ss=mysqli_fetch_assoc($que)['following'];
                        $ar=json_decode($ss);
                    
                        if(in_array($userId,$ar)){
                    ?>
                        <button class="btn btn-outline-secondary" id="follow-btn" onclick="followUser(<?php echo $userId;?>)">UnFollow</button>
                    <?php }else{?>
                        <button class="btn btn-primary" id="follow-btn" onclick="followUser(<?php echo $userId;?>)">Follow</button>
                    <?php } ?>
                </div>
                <div class="col-sm-1 mx-2 my-2 text-center"><a href="chat.php?user=<?php echo $userName;?>" class="btn btn-info">Chat</a></div>
            </div>
        </div>
    </div>
    <h4 class="my-3">Following</h4>
    <div class="row mx-auto my-3 border">
        
        <?php 
            foreach($followingList as $user){
                $selectQuery="select * from userdetailstb where id=$user";    
                $qu = mysqli_query($conn,$selectQuery) or die(error_page());
                $qpc=mysqli_fetch_assoc($qu);
        ?>
            <a class="btn col-sm-6 text-left my-2" href="profileshow.php?userName=<?php echo $qpc['username'];?>">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $qpc['profilepic'];?>" style="width:25px;height:25px;"> <span class="text-secondary"><?php echo $qpc['username']; ?></span>
            </a>

        <?php
            }
        ?>
    </div>
</div>