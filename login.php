<!-- code for login page -->

<?php
require_once 'includes/header.php';
?>

<h1>Login</h1>
<p>No account? <a href="register.php">Register here!</a></p>

<div>
	<form action="includes/login-inc.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="submit">LOGIN</button>
	</form>
</div>

<?php
require_once 'includes/footer.php';
?>