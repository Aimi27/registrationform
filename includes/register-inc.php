<?php

// this whole script handles errors in the form

if (isset($_POST['submit'])) {
	// make it when the submit button is clicked, there is a database connection
	require 'database.php';
	
	// fetch information from the register form with POST method 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPass = $_POST['confirmPassword'];
	
	// check if all fields are filled in because null input is not allowed
	if (empty($username) || empty($password) || empty($confirmPass)) {
		// redirect user to the same form with an error message
		header("Location: ../register.php?error=emptyfields&username=".$username);
		exit();
	} elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
		// error if username doesn't meet criteria
		header("Location: ../register.php?error=invalidusername&username=".$username);
		exit();
	} elseif ($password !== $confirmPass) {
		// error if password doesn't match confirmpassword
		header("Location: ../register.php?error=passwordsdonotmatch&username=".$username);
		exit();
	} else {
		// this is where we check if the input matches a row in the database to avoid duplicates
		$sql = "SELECT username FROM users WHERE username = ?";
		// new variable called statement
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../register.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username); // s stands for string
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			// see how many results we're getting from the database
			$rowCount = mysqli_stmt_num_rows($stmt);
			
			if ($rowCount > 0) {
				// redirect user to register page with an error message
				header("Location: ../register.php?error=usernametaken");
				exit();
			} else {
				$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../register.php?error=sqlerror");
					exit();
				} else {
					// new variable hashed password
					$hashedPass = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPass); // s stands for string
					mysqli_stmt_execute($stmt);
					header("Location: ../register.php?success=registered");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt); //closing off the statement
	mysqli_close($conn); //closing off database connection
}

?>