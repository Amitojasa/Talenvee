<link rel="stylesheet" href="includes/css/profile.css">
<div class="container border my-2">

<div class="card m-2">
  <div class="card-header"><b>BeatBoxing</b></div>
    <div class="card-body d-flex justify-content-between">
        <div class="left d-flex">
            <a class="mx-1" href="#">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $profile;?>" style="width:25px;height:25px;"> <?php echo $userName; ?>
            </a>
            <h6 class="mx-2"> VS </h6>
            <a class="mx-1" href="#">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $profile;?>" style="width:25px;height:25px;"> <?php echo $userName; ?>
            </a>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary">View</a>        
        </div>

    </div> 
    <div class="card-footer"> 
        <div id="post-tags">
            <?php 
                // $tags=json_decode($r['tags']);
                // foreach($tags as $i){ ?>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>Hello</div>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>beatboxing</div>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>competition ID</div>
            <?php //} ?>
        </div>
    </div>
</div>
<div class="card m-2">
  <div class="card-header"><b>BeatBoxing</b></div>
    <div class="card-body d-flex justify-content-between">
        <div class="left d-flex">
            <a class="mx-1" href="#">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $profile;?>" style="width:25px;height:25px;"> <?php echo $userName; ?>
            </a>
            <h6 class="mx-2"> VS </h6>
            <a class="mx-1" href="#">
                <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $profile;?>" style="width:25px;height:25px;"> <?php echo $userName; ?>
            </a>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary">View</a>        
        </div>

    </div> 
    <div class="card-footer"> 
        <div id="post-tags">
            <?php 
                // $tags=json_decode($r['tags']);
                // foreach($tags as $i){ ?>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>Hello</div>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>beatboxing</div>
                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php// echo $i;?>competition ID</div>
            <?php //} ?>
        </div>
    </div>
</div>

</div>