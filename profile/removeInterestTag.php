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
        echo "login";
    }else{
        $tag=mysqli_real_escape_string($conn,$_GET['tag']);
        $qu=mysqli_query($conn,"select interests from userdetailstb where id='$uid'") or die(error_page());
        $q=mysqli_fetch_assoc($qu)['interests'];
        $interests=json_decode($q);

        
        if(in_array($tag,$interests)){

            $key = array_search($tag,$interests);
            array_splice($interests,$key,1);  
            $jsonCart = json_encode($interests);
            mysqli_query($conn,"update userdetailstb set interests='$jsonCart' where id='$uid'") or die(error_page());
            echo "removed";
        }
        else{

            echo "Sorry";
        }
    }
    
?>