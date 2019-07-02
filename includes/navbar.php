<script>
function searchUser (search_str){
    $.ajax({
        url:"search_user.php?search_str="+search_str, //the page containing php script
        type: "POST", //request type
        success:function(result){
            document.getElementById('search_result').innerHTML=result;
        }
    });
}
</script>

<?php

    $mq=mysqli_query($conn,"select * from messages where toId=$uid and status=0 limit 1") or die(error_page());
    if(mysqli_num_rows($mq)){
        $chat=true;
    }else{
        
        $chat=false;
    }

    
    // $nq=mysqli_query($conn,"select * from notification where toId=$uid and status=0 limit 1") or die(error_page());
    // if(mysqli_num_rows($nq)){
    //     $noti=true;
    // }else{
        
        $noti=false;
    // }


?>

<link rel="stylesheet" href="includes/css/navbar.css">

<nav class="navbar navbar-expand-xl navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">Talenvee</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="create.php">Create Post</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contactUs.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if($chat) echo ' activate-border border';?>" href="chat.php">Chat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compete.php">Compete</a>
        </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mx-2 my-1">
            <form method="GET" action="tagsResult.php">
            <!-- <div class="input-group mb-3">
                    <input class="form-control mr-sm-2" style="width:300px;" type="text" placeholder="Search tag" name="tag">
                <div class="input-group-append">
                    <button class="btn btn-secondary"> <i class="fa fa-search"></i> </button>
                </div>
            </div> -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Tag" name="tag">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button> 
                </div>
            </div>
            </form>
        </li>
        <li class="nav-item dropdown my-1 mx-2">
            <form method="POST">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search User" onkeyup="searchUser(this.value)" data-toggle="dropdown">
                    <div id="search_result" class="dropdown-menu"></div>
            </form>
        </li>
        <li class="nav-item">
        <a href="notifications.php" class="nav-link<?php if($noti) echo ' activate-border border';?>"><span><i class="fas fa-bell"></i></span><span class="d-inline d-lg-none"> Notification</span></a>
        </li>
        <li class="nav-item dropdown">
    
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $profile;?>" style="width:25px;height:25px;"> <?php echo $userName; ?>
        </a>
        <div class="dropdown-menu">
                <a class="dropdown-item" href="myprofileShow.php">Profile</a>
                <a class="dropdown-item" href="profileSetup.php">Edit</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
  </div>
</nav>