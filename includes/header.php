<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    ?>
<?php
    include_once('conn.inc.php');
   
?>
<?php

function getMentions($content)
{
    require_once('includes/conn.inc.php');

global $conn;
$mention_regex = '/@\[([0-9]+)\]/i'; //mention regrex to get all @texts

if (preg_match_all($mention_regex, $content, $matches))
{
foreach ($matches[1] as $match)
{
$match_user =mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM userdetailstb WHERE id=$match"));

$match_search = '@[' . $match . ']';
$match_replace = '<a target="_blank" href="profileshow.php?userName='. $match_user['username'] .'">@' . $match_user['username'] . '</a>';

if (isset($match_user['id']))
{
$content = str_replace($match_search, $match_replace, $content);
}
}
}
return $content;
}
?>

<?php
	if (@$_SESSION['login']==true){
        $login=true;
        $uid=$_SESSION['userid'];
        $r=mysqli_query($conn,"select username,profilepic from userdetailstb where id='$uid'") or die(error_page());
        $s=mysqli_fetch_assoc($r);
        $userName=$s['username'];
        $nav='navbar.php';
        $profile=$s['profilepic'];
	}else{
        $login=false;
        $userName="My Account";
        $nav='navbar-login.php';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link href='includes/mentions/assets/style.css' rel='stylesheet' type='text/css'> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/solid.css" integrity="sha384-ioUrHig76ITq4aEJ67dHzTvqjsAP/7IzgwE7lgJcg2r7BRNGYSK0LwSmROzYtgzs" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/regular.css" integrity="sha384-hCIN6p9+1T+YkCd3wWjB5yufpReULIPQ21XA/ncf3oZ631q2HEhdC7JgKqbk//4+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/fontawesome.css" integrity="sha384-sri+NftO+0hcisDKgr287Y/1LVnInHJ1l+XC7+FOabmTTIK0HnE2ID+xxvJ21c5J" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href='includes/mentions/jquery.mentionsInput.css' rel='stylesheet' type='text/css'>

 <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
  <!-- <script src='//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js' type='text/javascript'></script> -->
  <script src="https://cdn.rawgit.com/jashkenas/underscore/1.8.3/underscore-min.js" type="text/javascript"></script>

    <script src='includes/mentions/jquery.mentionsInput.js' type='text/javascript'></script>
    <script src='includes/mentions/lib/jquery.events.input.js' type='text/javascript'></script>
  <script src='includes/mentions/lib/jquery.elastic.js' type='text/javascript'></script>
  <!-- <script src='jquery.mentionsInput.js' type='text/javascript'></script> -->
  <title>Talenvee</title>
</head>
<body>
<?php

    include $nav;
?>