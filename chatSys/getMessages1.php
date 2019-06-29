<?php  
    include '../includes/conn.inc.php';
    function is_url($uri){
        if(preg_match( '/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/' ,$uri)){
          return true;
        }
        else{
            return false;
        }
    }
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $uid=$_SESSION['userid'];
    $from=$_SESSION['from'];

    $to=$_SESSION['to'];
    $q=mysqli_query($conn,"select * from messages where fromId=$from and toId=$to union select * from messages where toId=$from and fromId=$to order by id") or die(error_page());
    $chats="";
    while($r=mysqli_fetch_assoc($q)){
        $idn=$r['id'];
        mysqli_query($conn,"update messages set status=1 where id=$idn and toId=$uid") or die(error_page());
        $chat=$r['message'];
        if(is_url($chat)){
            $chat="<a target='_blank' href='".$chat."'>".$chat."</a>";
        }

        $fromId=$r['fromId'];
        $qu=mysqli_query($conn,"select * from userdetailstb where id=$fromId") or die(error_page());
        $rs= mysqli_fetch_assoc($qu);
        if($fromId==$uid){
            $chats.= "<div class='single-msg text-right'><div class='from my-1 d-inline-flex ml-auto p-2'><strong>".$rs['username']." : </strong><span class='msg-txt'>".$chat ."</span><span class='date'>".date('d-m-Y h:i:a',strtotime($r['time']))."</span> </div>";
        }else{
            $chats.= "<div class='single-msg text-left'><div class='to my-1 d-inline-flex mr-auto p-2'><strong>".$rs['username']." : </strong><span class='msg-txt'>".$chat ."</span><span class='date'>".date('d-m-Y h:i:a',strtotime($r['time']))."</span> </div>";
        }
        
    }
    echo $chats;
?>

