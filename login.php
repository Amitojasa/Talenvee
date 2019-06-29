<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (@$_SESSION['login']==true){
		header("Location: index.php");
		exit;
	}
?>

<?php require 'includes/conn.inc.php';?>
<?php

	if(isset($_POST['submit'])){
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$pass = mysqli_real_escape_string($conn,$_POST['password']);
    $pass=md5($pass);
	  	$r=mysqli_query($conn,"Select linkUserId,password from logintb where emailId='$email'") or die(error_page());

		$r=mysqli_fetch_assoc($r);
		
		if($pass==$r['password']){
			$_SESSION['login']=true;
			$_SESSION['userid']=$r['linkUserId'];
			$_SESSION['email']=$email;
			
      header("Location: index.php");
    	exit;
		}else{
			echo "<script>alert('Incorrect Password')</script>"  ; 
		}
	

  }

?>
<?php include 'includes/header.php';?>

<link rel="stylesheet" href="css/login.css">
<section class="checkout-section ptb-70">
   <div class="bcg"></div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-8 col-md-8  card my-5 shadow">
            <div class="card-body">
              <form class="main-form full" method="post">
                <div class="row">
                  <div class="col-12 mb-20">
                    <div class="heading-part heading-bg mb-4">
                      <h2 class="heading">User Login</h2>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" id="login-email" name="email" type="email" placeholder="Email Address" required>
                    </div>
                  </div>
                  <div class="col-12">
                         <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text fa fa-key"></span>
                            </div>
							<input class="form-control" id="login-pass" name="password" type="password" placeholder="Password" required>
                        </div>
                  </div>
                  
                  <div class="col-7"> <a title="Forgot Password" class="forgot-password mtb-20" href="forgotpass.php">Forgot your password?</a>
                </div>
                  <div class="col-5">
                    <button name="submit" type="submit" class="btn btn-primary pull-right">Log In</button>
                  </div>
              </div>
                    <hr>
                  </div>
                  <div class="col-12">
                    <div class="new-account text-center mt-20"> <span>New to Talent Hut ?</span> <a class="link" title="Register with Everypick" href="register.php">Create New Account</a> </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <?php include 'includes/footer.php';?>