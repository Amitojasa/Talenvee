<?php 
    
    require "../includes/conn.inc.php";
    $uname=mysqli_real_escape_string($conn,$_GET['uname']);
    
    $r=mysqli_query($conn,"select * from userdetailstb where username='$uname'") or die(error_page());
    if(mysqli_num_rows($r)>0){
        echo "<span class='text-danger'>User already Exists.</span>";
    }else{
        echo "<span class='text-success'>You can take this name.</span>";
    }


?>