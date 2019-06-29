<?php

include "includes/conn.inc.php";
$from=mysqli_real_escape_string($conn,$_POST['email']);
$name=mysqli_real_escape_string($conn,$_POST['name']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);

$sub="$name sent this message.. from Talenvee";
$headers="From: ".$from;

// mail("gadgetspick@gmail.com",$sub,$msg,$headers) or die("!!! Message not sent !!!");
mail("singh99amitoj@gmail.com",$sub,$msg,$headers) or die("!!! Message not sent !!!");
mysqli_query($conn,"INSERT INTO `contact`( `name`, `email`, `msg`) VALUES ('$name','$from','$msg')");
echo "sent";
echo "<a href='/'><h2>Return to Website</h2></a>"

?>