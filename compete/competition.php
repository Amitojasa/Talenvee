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
<div class="container border my-2">

<div class="alert alert-danger m-2">
    To compete contact us <a href="chat.php?user=talenvee">here</a>
</div>

<?php 
    $query=mysqli_query($conn,"select * from competition order by id desc") or die(error_page());
    while($rs=mysqli_fetch_assoc($query)){
        $user1=$rs['user1'];
        $user2=$rs['user2'];
?>

<div class="card m-2">
  <div class="card-header"><b><?php echo $rs['heading'];?></b></div>
    <div class="card-body d-flex justify-content-between">
        <div class="left d-flex">
            <?php 
                $q1=mysqli_query($conn,"select * from userdetailstb where id=$user1") or die(error_page());
                $r1=mysqli_fetch_assoc($q1);
            ?>
            <a class="mx-1" href="profileshow.php?userName=<?php echo $r1['username'];?>">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $r1['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $r1['username']; ?>
            </a>
            <h6 class="mx-2"> VS </h6>
            <?php 
                $q2=mysqli_query($conn,"select * from userdetailstb where id=$user2") or die(error_page());
                $r2=mysqli_fetch_assoc($q2);
            ?>
            <a class="mx-1" href="profileshow.php?userName=<?php echo $r2['username'];?>">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $r2['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $r2['username']; ?>
            </a>
        </div>
        <div class="right">
            <?php if($rs['status']==0){?>
                <a href="#" class="btn btn-outline-secondary">Ended</a>  
            <?php }else{ ?>
                <a href="#" class="btn btn-success">onGoing</a>  
            <?php } ?>
                  
            <a href="viewCompetition.php?id=<?php echo $rs['id'];?>" class="btn btn-primary">View</a>        
        </div>

    </div> 
    <div class="card-footer"> 
        <div id="post-tags">
            <?php 
                $tags=json_decode($rs['tags']);
                foreach($tags as $i){ ?>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php echo $i;?></div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    }
?>

</div>