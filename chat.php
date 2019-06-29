
<?php include 'includes/header.php'; ?>

<?php
if(@$_GET['user']!=""){
    include 'chatSys/chatWindow.php';
}else{
    include 'chatSys/chatWith.php';
}
?>

<?php include 'includes/footer.php'; ?>