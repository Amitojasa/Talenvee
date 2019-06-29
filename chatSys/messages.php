<?php  
    include '../includes/conn.inc.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $from=$_SESSION['from'];
    $to=$_SESSION['to'];
    $msg=mysqli_real_escape_string($conn,$_GET['message']);
   
    // echo $msg;
    $q=mysqli_query($conn,"Insert into messages(`fromId`, `toId`, `message`) values($from,$to,'$msg') ") or die(error_page());
    if($q){
        echo 1;
        exit;
    }
?>