<?php 
include_once('lib/header.php'); 
require_once('functions/alerts.php'); 
?> 

<h3>Forgot Password</h3>
<p>Provide the email associated with your account</p>

<form action="processForgot.php" method="POST">

	<p>
		 <?php print_error(); print_message();?>  
    </p>
     
		<label>Email </label><br>
        <input 
 
        <?php
            if(isset($_SESSION['email'])){
                echo "value =" . $_SESSION['email'];

            }

         ?>

        type="email" name="email" placeholder="enter your email" /><br> 
    </p>

    <p>
    <button type="submit">Send Reeset Code </button>
	</p>

</form>


 <?php include_once('lib/footer.php');  ?>