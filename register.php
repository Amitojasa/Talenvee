<?php require "includes/conn.inc.php"; ?>

<script>
function validateUser(val)
{
    var regex = /^[a-zA-Z_0-9]+$/;
    if (regex.test(val)) {
        return true;
    }
    else {
        return false;
    }
}
function checkUser (){
    uname=document.getElementById('U-name').value;
    if(validateUser(uname)){
        $.ajax({
            url:"validations/checkUser.php?uname="+uname, //the page containing php script
            type: "POST", //request type
            success:function(result){
                document.getElementById('resultUname').innerHTML=result;
                if(result=="<span class='text-danger'>User already Exists.</span>"){
                    document.getElementById('U-name').value=""; 
                }
           }
         });
    }else{
      document.getElementById('resultUname').innerHTML="<span class='text-danger'>You cal only use alphabets, numbers and _ </span>";
    }
}
function checkEmail (){
    email=document.getElementById('login-email').value;
        $.ajax({
            url:"validations/checkEmail.php?email="+email, //the page containing php script
            type: "POST", //request type
            success:function(result){
                document.getElementById('resultEmail').innerHTML=result;
                if(result=="<span class='text-danger'>Email already Exists.</span>"){
                    document.getElementById('login-email').value=""; 
                }
           }
         });
    }
function checkPass (){
    pass=document.getElementById('login-pass').value;
    repass=document.getElementById('re-enter-pass').value;
    if(pass!==repass){
        document.getElementById('resultpass').innerHTML="<span class='text-danger'>Password don't match</span>";
        document.getElementById('sub-but').disabled = true;
    }else{
        document.getElementById('resultpass').innerHTML="";
        document.getElementById('sub-but').disabled = false;
    }
    
    }
</script>

<?php

	if(isset($_POST['submit-register'])){
		$uname=mysqli_real_escape_string($conn,$_POST['Uname']);
		$fname=mysqli_real_escape_string($conn,$_POST['fName']);
		$lname=mysqli_real_escape_string($conn,$_POST['lName']);
		$email=mysqli_real_escape_string($conn,$_POST['eMail']);
		$phone=mysqli_real_escape_string($conn,$_POST['phone']);
		$pass=mysqli_real_escape_string($conn,$_POST['pass']);
    $repass=mysqli_real_escape_string($conn,$_POST['repass']);

		if($pass==$repass){
			mysqli_query($conn,"Insert into userdetailstb(username,firstName,lastName,emailAddress,contactNo1) values('$uname','$fname','$lname','$email','$phone')") or die(error_page());
			$pass=md5($pass);
			$last_id=mysqli_query($conn,"select LAST_INSERT_ID()") or die(error_page());
			$last_id=mysqli_fetch_array($last_id);
			$last_id=$last_id[0];
			mysqli_query($conn,"Insert into logintb(emailId,password,linkUserId) values('$email','$pass','$last_id')") or die(error_page());
      header("Location: login.php");
    	exit;
		}else{
            echo "<script>alert('Password don't match')</script>";
        }

	}
  

?>
<?php include "includes/header.php"; ?>

<link rel="stylesheet" href="css/register.css">
<section class="checkout-section ptb-70">
    <div class="clip"></div>
    <div class="container">
      <div class="row">
        <div class="col-12">
            <div id="msgShow"class="alert-danger">

            </div>
          <div class="row justify-content-center">
          
            <div class="col-xl-8 col-lg-8 col-md-8 ">
            <div class="card my-5">
          <div class="card-body">
              <form class="main-form full" method="post">
                <div class="row">
                  <div class="col-12 mb-20">
                    <div class="heading-part heading-bg">
                      <h2 class="heading text-center text-primary p-3 mt-3">Create your account</h2>
                    </div>
                    <hr>
                  </div>
                  <div class="col-12">
                    <div class="heading-part line-bottom ">
                      <h2 class="form-title  text-secondary"><small>Your Personal Details</small></h2>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="user-name">User Name</label>
                      <input onkeyup="checkUser()" class="form-control" type="text" name="Uname" id="U-name" required placeholder="User Name(Should be unique)" required autocomplete="off">
                      <span id="resultUname"></span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="f-name">First Name</label>
                      <input class="form-control" type="text" name="fName" id="f-name" required="" placeholder="First Name" required>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group">
                      <label for="l-name">Last Name</label>
                      <input class="form-control" type="text" name="lName" id="l-name" required="" placeholder="Last Name" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="login-email">Email address</label>
                      <input onchange="checkEmail()" class="form-control" id="login-email" name="eMail" type="email" required="" placeholder="Email Address">
                      <span id="resultEmail"></span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="telephone">Phone no.</label>
                      <input class="form-control" id="telephone" name="phone" type="number" required="" placeholder="Phone No." required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="login-pass">Password</label>
                      <input  class="form-control" id="login-pass" name="pass" type="password" required="" placeholder="Enter your Password" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="re-enter-pass">Re-enter Password</label>
                      <input onkeyup="checkPass()" class="form-control" id="re-enter-pass" name="repass" type="password" required="" placeholder="Re-enter your Password" required>
                    </div>
                    <span id="resultpass"></span>
                  </div>
                  <div class="col-7 offset-5">
                    <button id="sub-but" name="submit-register" type="submit" class="btn btn-primary text-center">Submit</button>
                  </div>
                  <div class="col-12">
                    <hr>
                    <div class="new-account text-center mb-4"> <span>Already have an account with us</span> <a class="link" title="Register with Talent Hunt" href="login.php">Login Here</a> </div>
                  </div>
                </div>
              </form>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include "includes/footer.php"; ?>