<?php 
    
    require "includes/conn.inc.php";
    $searchStr=mysqli_real_escape_string($conn,$_GET['search_str']);
    if($searchStr==""){
        echo "";
    }else{
        $searchStr.='%';
        $r=mysqli_query($conn,"select * from userdetailstb where username like '$searchStr'") or die(error_page());
        $result="";
        while($q=mysqli_fetch_assoc($r)){
            $imgs='<img class="img img-fluid rounded-circle" src="profile/profile_pics/'.$q['profilepic'].'" style="width:25px;height:25px;">';
            $result.='<a class="dropdown-item" href="profileshow.php?userName='.$q['username'].'">'.$imgs.$q['username'].'</a>';
        }
        echo $result;
    }


?>
