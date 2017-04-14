<!-- 
	/****************************************************************************************************
	R. V. Sampangi. 2017. Solution for Server Side Scripting Assignment 3. In INFX2670: Introduction to 
	Server Side Scripting, Faculty of Computer Science, Dalhousie University, NS, Canada.
	****************************************************************************************************/

	This script displays the actual login form.
	Created a separate file for this form to facilitate re-use.
-->
<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>

 
<form action="includes/login.php" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" required>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" required>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="login" value="Login">
        <a class="btn btn-success" href="register.php">Register</a>
	</div>
</form>
<a href="#">Forgot password</a>

