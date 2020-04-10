 <?php
 session_start();
 session_unset();
 session_destroy();

 header("Location: login.php");


include_once('lib/header.php');
?>

<p>Reset password here</p>


<?php include_once('lib/footer.php');  ?>