<link rel="stylesheet" href="includes/css/profile.css">
<link rel="stylesheet" href="includes/css/myprofile.css">
<script src="includes/js/profile.js"></script>
<?php 
    if(isset($_POST['submitpass'])){
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $newrepass = $_POST['newrepass'];
    

        if($newpass==$newrepass){
            $r=mysqli_query($conn,"select password from logintb where linkUserId='$uid'") or die(mysqli_error($conn));
            $r = mysqli_fetch_assoc($r);
            $newpass=md5($newpass);
            if($r['password'] == md5($oldpass)){
                $q=mysqli_query($conn,"update logintb set password = '$newpass' where linkUserId='$uid'");
                if($q){
                    echo "<script>alert('Password Changed Successfully')</script>";        
                    // echo "<script>
                    //     var x = document.getElementById('changedpass'); 
                    //     x.style.diplay = block;
                    // </script>";
                }
            }else{
                echo "<script>alert('Old Password entered is wrong!!')</script>";
                // $msg="Wrong Old Password";
                // echo "<script>
                //     var x = document.getElementById('wrong'); 
                //     x.style.diplay = block;
                // </script>"; 
            }
        }else{
            echo "<script>alert('New Password does not match with Re-type Password!!')</script>"  ; 
            // $msg = "New password and Re-enter password doesnt match";
            // echo "<script>
            //     var x = document.getElementById('wrong'); 
            //     x.style.diplay = block;
            // </script>"; 
        }
    }
?>

<?php
    $userId=$_SESSION['userid'];
                        
    $que=mysqli_query($conn,"select * from userdetailstb where id='$userId'") or die(error_page());
    $ss=mysqli_fetch_assoc($que);
    $userName=$ss['username'];
    $interests=json_decode($ss['interests']);
?>

<?php
    if(isset($_POST['sub-userName'])){
        $newUserName=mysqli_real_escape_string($conn,$_POST['username']);
        $r=mysqli_query($conn,"update userdetailstb set username='$newUserName' where id=$userId") or die(error_page());
        echo "<script>window.location = 'profileSetup.php'</script>";
    }
    if(isset($_POST['sub-desc'])){
        $newDesc=mysqli_real_escape_string($conn,$_POST['description']);
        $r=mysqli_query($conn,"update userdetailstb set UserDesc='$newDesc' where id=$userId") or die(error_page());
        echo "<script>window.location = 'profileSetup.php'</script>";
    }

?>

<div class="container my-3 mx-auto">
    <div class="row bg-light  text-center p-3" id="profile-header">
        <div class="col-sm-12" >
            <img id="profile-pic" src="profile/profile_pics/<?php echo $ss['profilepic'];?>" alt="" class="img-fluid rounded-circle border"> <span class="text-primary btn" onclick='editPhoto();'><i class="far fa-edit"></i></span>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6 text-left ">
                    <h5 class="my-3"><a id="profile-name" class="text-dark" href="profileshow.php?userName=<?php echo $ss['username'];?>"><?php echo $ss['username'];?></a> <small class="text-primary btn" onclick='usernameChange();'><i class="far fa-edit"></i></small> </h5>
                </div>
                <div class="col-sm-6 my-3 text-justify" id="username-form">
                    <form method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <input onkeyup="checkUser();" name="username" id="username" rows="3" value="<?php echo $ss['username'];?>" class="form-control" autocomplete="off">
                            <span id="resultUname"></span>
                        </div>
                        
                        <div class="col-sm-2">
                            <input type="submit" id="sub-userName" value="Update" name="sub-userName"  class="btn btn-primary">
                        </div>
                        <div class="col-sm-2">
                            <span id="sub-userName-cancel" class="btn btn-secondary" onclick="clearDisplay('username-form');"  >Cancel</span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class=" col-sm-12 my-3">
            <div class="row">
                <div class="col-sm-5 d-flex text-justify my-2">
                    <p class=""><?php echo $ss['UserDesc'];?></p>
                </div>
                <span class=" text-primary btn col-sm-1"><i class="far fa-edit" onclick='descChange();'></i></span>
            
                <div class="col-sm-6 my-3 text-right" id="desc-form">
                    <form method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <textarea name="description" id="desc" rows="3" class="form-control"><?php echo $ss['UserDesc'];?></textarea>
                        </div>
                        <div class="col-sm-2 ">
                            <input type="submit" value="Update" name="sub-desc" class="btn btn-primary">
                        </div>
                        <div class="col-sm-2">
                            <span id="sub-desc-cancel" class="btn btn-secondary" onclick="clearDisplay('desc-form');"  >Cancel</span>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="interests">
        <div class="interests my-3 col-sm-12" id="intertagcard">
                <div class="card">
                    <div class="card-header text-center d-flex justify-content-between">
                        <h5 class="text-primary text-left ">Interests</h5><small class="text-left">You can add max 20 tags.</small>
                        <a class=" btn btn-sm text-right text-primary" onclick="interestEdit();">Edit</a>
                    </div>
                    <div id="interest-body" class="card-body">
                        
                            <?php foreach($interests as $i){ ?>
                                <div id="tags-tag" class="tag bg-primary text-white px-2"><?php echo $i;?><span class="mx-2 closer" onclick="removeTag('<?php echo $i;?>')"><i class="fa fa-times-circle" aria-hidden="true"></i></span></div>
                            <?php } ?>
                       
                    </div>
                </div>
            
            <br>
            <form class="col-sm-6" id="interest-form" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" id="input-tag">
                    <div class="input-group-append">
                        <span onclick="addTag();" class="form-control btn btn-primary">Add</span>
                    </div>
                    <div class="input-group-append">
                        <span id="sub-interest-cancel" class="btn btn-secondary" onclick="clearDisplayInter('interest-form');"  >Cancel</span>
                    </div>

                </div>
            </form>
            </div>
    </div>
    <div class="section border p-3">
    
        <div class="row">
            <div class="col-12">
                <div class="heading">
                    <h2 class="bg-light p-3">Change Password</h2>
                </div>
            </div>
        </div>
                <div class="row px-5 py-2"></div>
                    <form class="main-form full" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="old-pass">Old-Password</label>
                                    <input type="password" placeholder="Old Password" required id="old-pass" name="oldpass" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="login-pass">Password</label>
                                    <input type="password" placeholder="Enter your Password" required id="login-pass" name="newpass" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="re-enter-pass">Re-enter Password</label>
                                    <input type="password" placeholder="Re-enter your Password" required id="re-enter-pass" name="newrepass" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button class="btn btn-primary" type="submit" name="submitpass">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
