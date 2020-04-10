<?php

include_once('lib/header.php');

if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
    header("Location: dashboard.php");
}



?>

<h2>Register</h2>

    <p><strong>Welcome, Please Register</strong></p>
    <p>All Fields are required</p>

  <form method="post" action="process_register.php"> <!-- Creates a form -->

<p>
    <?php 

    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        echo $_SESSION['error'];

        session_destroy();
    }

     ?>
</p>


    <p>
		<label>First Name: </label><br>
         <input type="text" name="first_name" placeholder="Enter Your First Name" required /><br>
    </p>
    <p>
        <label>Last Name: </label><br>
         <input 
         <?php
            if(isset($_SESSION['first_name'])){
                echo "value =" . $_SESSION['first_name'];

            }

         ?>

         type="text" name="last_name" placeholder="Enter Your Last Name" /><br>
    </p>
    <p>
         <label>Email: </label><br>
         <input type="email" name="email" placeholder="Enter Your Email" required required/><br>
    </p>
    <p>
        <label>Password: </label><br>
        <input type="password" name="password" placeholder="Enter Your password" required /><br>
    </p>
    <p>
        <label>Confirm Password: </label><br>
        <input type="c_password" name="c_password" placeholder="confirm password" required /><br>
         <!--the above code creates a text box --> 
    </p>
 
        <label>Select your Designation: </label><br>
         <select name="designation" required> <!--  creates drop down menu -->
            <option value=" ">select one</option>
         	<option value="Teller">Teller</option>
         	<option value="Security">Security</option>
         	<option value="Customer_serv">Customer service</option>
         </select>

		<p>
		<label>Gender: </label> <br> <!-- creates radio botton -->
		<input type="radio" name="gender" value="male" required>male<br>
		<input type="radio" name="gender" value="female" required>female<br>
        </p>

         <button type="submit" name="submit">Register</button> 
</form>

</body>
</html>

<?php include_once('lib/footer.php');  ?>