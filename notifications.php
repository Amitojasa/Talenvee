<?php include 'includes/header.php';?>

<div class="container mx-auto my-3">
    <ul class="list-group">
    <?php
        $querys=mysqli_query($conn,"SELECT * FROM `notification` WHERE toId=$uid order by id desc");
        if(!$querys){ echo "No notifications"; return;}
        while($r=mysqli_fetch_assoc($querys)){
            $ii=$r['id'];
            mysqli_query($conn,"update notification set status=1 where toId=$uid and id=$ii");

            $fromId=$r['fromId'];
            $qu=mysqli_query($conn,"select * from userdetailstb where id=$fromId") or die("Error occured");
            $rs= mysqli_fetch_assoc($qu);
            if($r['msg']=="following"){
                ?>
                <li class="list-group-item d-flex justify-content-between"><span class="text-left"><a href="profileshow.php?userName=<?php echo $rs['username'];?>"><?php echo $rs['username'];?></a> started following you.</span>
                <small class="text-secondary"><?php 
                                $dt = new DateTime($r['time']);
                                echo $dt->format('Y-m-d');?></small>
                </li>
                <?php
            } else if($r['msg']=="mentioned"){
                $cid=$r['commentId'];
                $qub=mysqli_query($conn,"select * from comments where id=$cid") or die("Error occured");
                $rst= mysqli_fetch_assoc($qub);
                ?>
                <li class="list-group-item d-flex justify-content-between"><span class="text-left"><a href="profileshow.php?userName=<?php echo $rs['username'];?>"> <?php echo $rs['username'];?> </a>mentioned you.</span>
                <a href="single.php?pid=<?php echo $rst['postId'];?>">View</a>
                <small class="text-secondary"><?php 
                                $dt = new DateTime($r['time']);
                                echo $dt->format('Y-m-d');?></small>
                </li>
                <?php
            }
        }
    ?>
    </ul>
</div>

<?php include 'includes/footer.php';?>
