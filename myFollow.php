<?php include 'includes/header.php'; ?>
<?php 
    if(mysqli_real_escape_string($conn,$_GET['category'])=='following'){
        include 'profile/myFollowing.php';
    }else if(mysqli_real_escape_string($conn,$_GET['category'])=='followers'){
        include 'profile/myFollower.php';
    }else{
        include '404.php';
    }
?>

<?php include 'includes/footer.php'; ?>