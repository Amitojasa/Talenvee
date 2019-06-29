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
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $qu=mysqli_query($conn,"select following from userdetailstb where id='$uid'") or die(error_page());
        $q=mysqli_fetch_assoc($qu)['following'];
        $following=json_decode($q);

        $qu1=mysqli_query($conn,"select followers from userdetailstb where id='$id'") or die(error_page());
        $q1=mysqli_fetch_assoc($qu1)['followers'];
        $followers=json_decode($q1);
        
        if(in_array($id,$following)){

            $key = array_search($id,$following);
            array_splice($following,$key,1);  
            $jsonCart = json_encode($following);
            mysqli_query($conn,"update userdetailstb set following='$jsonCart' where id='$uid'") or die(error_page());     
            
            $key = array_search($uid,$followers);
            array_splice($followers,$key,1);  
            $jsonCart = json_encode($followers);
            mysqli_query($conn,"update userdetailstb set followers='$jsonCart' where id='$id'") or die(error_page());     
            echo "unfollow";    
        }
        else{
            array_push($following,$id);
            $jsonCart = json_encode($following);
            mysqli_query($conn,"update userdetailstb set following='$jsonCart' where id='$uid'") or die(error_page());

            array_push($followers,$uid);
            $jsonCart = json_encode($followers);
            mysqli_query($conn,"update userdetailstb set followers='$jsonCart' where id='$id'") or die(error_page());
            mysqli_query($conn,"insert into notification(`msg`, `fromId`, `toId`) values('following',$uid,$id)") or die(error_page());

            echo "follow";
        }


        
    }
    
?>