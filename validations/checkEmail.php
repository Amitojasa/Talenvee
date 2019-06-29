<?php 
    
    require "../includes/conn.inc.php";
    $email=mysqli_real_escape_string($conn,$_GET['email']);
    
    $r=mysqli_query($conn,"select * from userdetailstb where emailAddress='$email'") or die(error_page());
    if(mysqli_num_rows($r)>0){
        
        echo "<span class='text-danger'>Email already Exists.</span>";
    }else{
        echo "";
    }

?>