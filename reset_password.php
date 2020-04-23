<?php 
include_once('lib/header.php');
require_once('functions/alerts.php');
require_once('functions/users.php'); 

if (!is_user_loggedin() && !is_token_set()) {
    $_SESSION["error"] = "You are not authorized to view that page" . $email;
                header("Location: login.php");
      # code...
  }  
?> 
 
<h3>Reset Password</h3>
<p>Reset Password associated with your account: [email]</p>

<form action="processreset.php" method="POST">

	<p>
		 <?php print_error(); print_message(); ?>  </p>
     <p>
     
		<label>Email </label><br>
        <input  

        <?php
            if(isset($_SESSION['email'])){

                echo "value=" . $_SESSION['email'];
            }

        ?>
        type="text" name="email" placeholder="Email" /><br> 
    </p>
    
    <?php if(is_user_loggedin()){ ?>
    <input 
    
        <?php
            if (is_token_set_in_session()) {
                echo "value='" . $_SESSION['token'] . "'";
            }else{
                echo "value='" . $_GET['token'] . "'";
            }

        ?>

        type="hidden" name="token"/>

    <?php } ?>

    <p>
        <label>Enter New Password: </label><br>
        <input type="password" name="password" placeholder="Enter Your password" required /><br>
    </p>

    <p>
    <button type="submit">Reset</button>
	</p>

</form>


 <?php include_once('lib/footer.php');  ?>