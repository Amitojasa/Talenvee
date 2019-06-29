<link rel="stylesheet" href="chatSys/chatwindow.css">

    <div class="container my-3">
        <div class="card" id="chat-body">
            <div class="card-header p-0 m-0">
                <?php 

                    $userName=mysqli_real_escape_string($conn,$_GET['user']);
                    $query22=mysqli_query($conn,"select id from userdetailstb where username='$userName'") or die(error_page());

                    $rq22=mysqli_fetch_assoc($query22)['id'];
                    $ai=$rq22;
                    if($ai==$uid){
                        die("sorry you can't chat with yourself");
                    }
                    if(!isset($_SESSION)) 
                    { 
                        session_start(); 
                    }

                    $_SESSION['from']=$uid;
                    $_SESSION['to']=$ai;
                    
                    $query1=mysqli_query($conn,"select * from userdetailstb where id=$ai") or die(error_page());
                    $rqs=mysqli_fetch_assoc($query1);
                ?>
                <a class="nav-link" href="profileshow.php?userName=<?php echo $rqs['username'];?>">
                    <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $rqs['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $rqs['username']; ?>
                </a>
            </div>
            <div class="card-body" id="chat-msgs" >
                    Loading....
            </div>
            <div class="card-footer">
            <form method="POST" id="chatForm">
                <textarea name="msg" id="msg" class="form-control textarea" placeholder="type some message"></textarea>
                <button type="submit" class="form-control btn btn-primary my-1">Send</button>
            </form>

            </div>
        </div>
        

    </div>
    <script src="chatSys/chat.js"></script>