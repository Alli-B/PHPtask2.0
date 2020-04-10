<?php 

include_once('lib/header.php');  
if(!isset($_SESSION['loggedin'])){
    header("Location: login.php");
}

?>
<h3>Dash Board</h3>
Logged User ID: 
<?php 
echo $_SESSION['loggedin'] ?>

Welcome, <?php echo $_SESSION['fullname'] ?> you are loogged in as (<?php echo $_SESSION['role'] ?>), and your ID is <?php echo $_SESSION['loggedin'] ?>



 <?php include_once('lib/footer.php');  ?>