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
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $query=mysqli_query($conn,"select * from posts where id=$id") or die(error_page());
        $r=mysqli_fetch_assoc($query);
        $qu=mysqli_query($conn,"select posts from userdetailstb where id='$uid'") or die(error_page());
        $q=mysqli_fetch_assoc($qu)['posts'];
        $fav=json_decode($q);
        if($r['imageSrc']!=""){
            // unlink("C:/xampp/htdocs/talent/".$r['imageSrc']);
            unlink("../".$r['imageSrc']);
        }
        if($r['videoSrc']!=""){
            unlink("../".$r['videoSrc']);
        }
        if(in_array($id,$fav)){
            $key = array_search($id,$fav);
            array_splice($fav,$key,1);  
            $jsonCart = json_encode($fav);
            mysqli_query($conn,"update userdetailstb set posts='$jsonCart' where id='$uid'") or die(error_page());         
        }
        mysqli_query($conn,"delete from posts where id='$id'") or die(error_page());
        mysqli_query($conn,"delete from comments where postId='$id'") or die(error_page());

    }
    
?>