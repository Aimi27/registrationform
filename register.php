<?php
require_once 'includes/header.php';
?>

<h1>Register</h1>
<p>Already have an account? <a href="login.php">Login here!</a></p>

<div>
	<!-- here is where we link the Submit button to register-inc.php -->
	<form action="includes/register-inc.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="password" name="confirmPassword" placeholder="Confirm password">
		<button type="submit" name="submit">REGISTER</button>
	</form>
</div>

<?php
require_once 'includes/footer.php';
?>