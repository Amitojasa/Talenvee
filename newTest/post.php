
<?php
if(isset($_POST) && !empty($_POST['text']) && $_POST['text'] != '')
{
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	if (@$_SESSION['login']==true){
        $login=true;
        $uid=$_SESSION['userid'];
	}else{
        echo "1";
        return;
    }

    require_once( '../includes/conn.inc.php');
global $conn;
$user =$_SESSION['userid']; //w3lessons demo user

$text = strip_tags($_POST['text']); //clean the text
$pid=$_GET['pid'];
mysqli_query($conn,"INSERT INTO comments(comment,authorId,postId) values('$text',$user,$pid)");
$last_id = mysqli_insert_id($conn);
$mention_regex = '/@\[([0-9]+)\]/i'; //mention regrex to get all @texts

if(preg_match_all($mention_regex, $text, $matches));

foreach ($matches[1] as $match)
{
    $to=$match;
mysqli_query($conn,"INSERT INTO notification(msg,fromId,toId,commentId) values('mentioned',$user,$to,$last_id)");
}

?>

<?php
}
?>

