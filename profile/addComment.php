<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
    require '../includes/conn.inc.php';
?>
<?php
	if (@$_SESSION['login']==true){
        $login=true;
        $uid=$_SESSION['userid'];
	}else{
        $login=false;
    }
?>

<?php 
    if(!$login){
        echo "Please Login";
    }else{
        $PostId=mysqli_real_escape_string($conn,$_GET['pid']);
        $comment=mysqli_real_escape_string($conn,$_GET['comment']);
        mysqli_query($conn,"INSERT INTO `comments`(`comment`, `postId`, `authorId`) VALUES ('$comment','$PostId','$uid')") or die(error_page());
        echo "inserted";
        
    }
    
?>