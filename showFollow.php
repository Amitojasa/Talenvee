<?php include 'includes/header.php'; ?>
<?php 
    if(mysqli_real_escape_string($conn,$_GET['category'])=='following'){
        include 'profile/showFollowing.php';
    }else if(mysqli_real_escape_string($conn,$_GET['category'])=='followers'){
        include 'profile/showFollower.php';
    }else{
        include '404.php';
    }
?>

<?php include 'includes/footer.php'; ?>