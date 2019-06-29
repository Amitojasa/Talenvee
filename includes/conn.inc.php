<?php
function error_page(){ echo "<script>window.location.href='/404.php'</script>";}
?>
<?php

    $host='localhost';
    $user='u435773219_ahuja';
    $pass='8P18bh0001$';
    $dbName='u435773219_talen';

    $conn=mysqli_connect($host,$user,$pass,$dbName) or die(error_page());

 
?>