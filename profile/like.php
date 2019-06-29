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
        $PostId=mysqli_real_escape_string($conn,$_GET['id']);
        $qu=mysqli_query($conn,"select likes,rating from posts where id='$PostId'") or die(error_page());
        $ss=mysqli_fetch_assoc($qu);
        $q=$ss['likes'];
        $fav=json_decode($q);
        $rate=$ss['rating'];
        if(in_array($uid,$fav)){
            $key = array_search($uid,$fav);
            array_splice($fav,$key,1);  
            $jsonCart = json_encode($fav);
            $rate=$rate-1;
            mysqli_query($conn,"update posts set likes='$jsonCart', rating=$rate where id='$PostId'") or die(error_page());
            echo "disliked";          
        }else{
            $rate=$rate+1;
            array_push($fav,$uid);
            $jsonCart = json_encode($fav);
            mysqli_query($conn,"update posts set likes='$jsonCart',rating=$rate where id='$PostId'") or die(error_page());
            echo "liked";
        }
    }
    
?>