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

<?php// require 'includes/conn.inc.php';?>

<?php include 'includes/header.php';?>

<link rel="stylesheet" href="css/login.css">
<section class="checkout-section ptb-70">
   <div class="bcg"></div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-8 col-md-8  card m-5 shadow">
            <div class="card-body">
              <form class="main-form full" action="mailtoforgot.php" method="post">
                <div class="row">
                  <div class="col-12 mb-20">
                    <div class="heading-part heading-bg mb-4">
                      <h2 class="heading">Email</h2>
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
                </div>
                  <div class="col-5">
                    <button name="submit" type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
                 
              </div>
              <hr>
                Check your mail.
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
  <?php //include 'includes/footer.php';?>