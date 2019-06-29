<?php
    // $userName=$_GET['userName'];
    // $query=mysqli_query($conn,"select id from userdetailstb where username='$userName'") or die(error_page());
    // $userId=mysqli_fetch_assoc($query)['id'];
    
    
?>

<?php
    
    $lUserId=$_SESSION['userid'];
    $userId=$lUserId;                    
    $que=mysqli_query($conn,"select * from userdetailstb where id='$userId'");// or die(error_page());
    $ss=mysqli_fetch_assoc($que);
?>
<link rel="stylesheet" href="includes/css/profile.css">
<link rel="stylesheet" href="includes/css/singlePost.css">
<script src="includes/js/profile.js"></script>
<div class="container my-3 p-0">
    <?php if($ss['interests']=="[]" || $ss['UserDesc']=="No description"){ ?>
          <div class="alert alert-danger d-flex justify-content-between"><span>Please Complete your Profile</span>  <a href="profileSetup.php">Edit</a>  </div>
        <?php } ?>
    <div class="row">
        
        <div class="col-md-8">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#folllowingResults"><small>Following</small></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#interestedTags"><small>Interested Tags</small></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#trending"><small>Trending</small></a>
                </li>
            </ul>

                <!-- Tab panes -->
            <div class="tab-content border">
                <div class="tab-pane container active" id="folllowingResults">
                    <?php include 'followingRes.php';?>
                </div>
                <div class="tab-pane container fade" id="interestedTags">
                    <?php include 'interestedTagHome.php';?>
                </div>
                <div class="tab-pane container fade" id="trending"><?php include 'trending.php'; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Suggestions</div>
                <?php include 'suggestions.php';?>
            </div>
        </div>
    </div>
    </div>
</div>