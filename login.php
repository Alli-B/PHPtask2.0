<?php session_start();

include_once('lib/header.php');

?>

<h2>Login</h2>
<?php 

    if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
        echo "<span style = 'color:green '>" . $_SESSION['message'] . "</span>";

        session_destroy();
    }

     ?>
</p>
 

  <form method="POST" action="proccesslogin.php"> <!-- Creates a form -->
    <?php

     if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        echo "<span style = 'color:red '>" . $_SESSION['error'] . "</span>";

        session_destroy();
    }

    ?>

    <p>
		<label>Email:</label>l 
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
