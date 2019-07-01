<?php
//function error_page(){ echo "<script>window.location.href='/404.php'</script>";}
?>
<?php

    $host='localhost';
    $user='root';
    $pass='';
    $dbName='talent';

    $conn=mysqli_connect($host,$user,$pass,$dbName);// or die(error_page());

 
?>