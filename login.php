<?php 

include_once('lib/header.php');
require_once('functions/alerts.php');

if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
    header("Location: dashboard.php");
}


?>

<h2>Login</h2>

<?php print_error();?>
</p>
 

  <form method="POST" action="proccesslogin.php"> <!-- Creates a form -->


    <p>
		<label>Email </label> 
        <input 
 
        <?php
            if(isset($_SESSION['email'])){
                echo "value =" . $_SESSION['email'];

            }

         ?>

        type="email" name="email" placeholder="enter your email" /><br> 
    </p>
        <label>Password </label> : 
        <input type="password" name="password" placeholder="Enter Your Pasword" /><br>
         
         

         <button type="submit">Login</button>
</form>

</body>
</html>

<?php include_once('lib/footer.php');  ?>
