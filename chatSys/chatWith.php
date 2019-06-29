<link rel="stylesheet" href="includes/css/profile.css">
<link rel="stylesheet" href="includes/css/myprofile.css">
<script src="includes/js/profile.js"></script>

<?php
    $userId=$_SESSION['userid'];
                        
    $que=mysqli_query($conn,"select * from userdetailstb where id='$userId'") or die(error_page());
    $ss=mysqli_fetch_assoc($que);
    $userName=$ss['username'];
?>

<div class="container my-3 mx-auto">
    <h3>Recent Chats</h3>
    <div class="row mx-auto my-3 border">
        <?php
                $sqls=mysqli_query($conn,"select * from messages where ( toId=$userId or fromId=$userId) order by id desc") or die(error_page());
                $list=array();
                while($rss=mysqli_fetch_assoc($sqls)){
                    if($rss['fromId']==$userId){
                        $user=$rss['toId'];
                    }else{
                        $user=$rss['fromId'];
                    }
                    if(in_array($user,$list)){
                        continue;
                    }else{
                        array_push($list,$user);
                    }
                    if(count($list)>50){
                        break;
                    }
                
                $selectQuery="select * from userdetailstb where id=$user";    
                $qu = mysqli_query($conn,$selectQuery) or die(error_page());
                $qpc=mysqli_fetch_assoc($qu);
        ?>
            <a class="btn col-sm-6 text-left my-2" href="chat.php?user=<?php echo $qpc['username'];?>">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $qpc['profilepic'];?>" style="width:25px;height:25px;">
                <?php if($rss['status']==0 && $rss['toId']==$userId){?>
                 <span class="text-dark"><b><?php echo $qpc['username']; ?></b></span>
                <?php }else{ ?>
                    <span class="text-secondary"><?php echo $qpc['username']; ?></span>
                <?php } ?>
            </a>

        <?php
            }
        ?>
    </div>
    <h3>Chat With</h3>
    <div class="row mx-auto my-3 border">
        <?php
            $followerList=json_decode($ss['followers']);
            $followingList=json_decode($ss['following']);
            $list=array_merge($followerList, $followingList);
            $list = array_unique($list);
            foreach($list as $user){
                if($userId==$user){
                    continue;
                }
                $selectQuery="select * from userdetailstb where id=$user";    
                $qu = mysqli_query($conn,$selectQuery) or die(error_page());
                $qpc=mysqli_fetch_assoc($qu);
        ?>
            <a class="btn col-sm-6 text-left my-2" href="chat.php?user=<?php echo $qpc['username'];?>">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $qpc['profilepic'];?>" style="width:25px;height:25px;"> <span class="text-secondary"><?php echo $qpc['username']; ?></span>
            </a>

        <?php
            }
        ?>
    </div>
</div>