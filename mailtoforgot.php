<?php
include 'includes/conn.inc.php';

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

	if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pass1=randomPassword();
        $pass=md5($pass1);
	  	$r=mysqli_query($conn,"update logintb set password='$pass' where emailId='$email'") or die("Account Does not exist");
    }


?>

<?php

$to=mysqli_real_escape_string($conn,$_POST['email']);
$sub="Password Reset from Talenvee";
$msg="Your new password is ".$pass1." . Please login and change password" ;
$headers="From: Talenvee";

// mail("gadgetspick@gmail.com",$sub,$msg,$headers) or die("!!! Message not sent !!!");
mail($to,$sub,$msg,$headers) or die("!!! Message not sent !!!");
echo "sent";
echo "<a href='/'><h2>Return to Website</h2></a>"
?>