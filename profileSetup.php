<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (@$_SESSION['login']==false){
	    echo "<script>alert('Please Login');</script>";
		header("Location: index.php");
		exit;
	}
?>

<?php include 'includes/header.php'; ?>
<?php include 'profile/profileEdit.php';?>
<?php include 'includes/footer.php'; ?>