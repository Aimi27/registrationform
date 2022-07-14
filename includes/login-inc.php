<!-- login-inc script -->

<?php

if (isset($_POST['submit'])) {
	
	require 'database.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// check if fields are filled in_array
	if (empty($username) || empty($password)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username = ?"; //sql query
		$stmt = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			// send error message if username does not belong in database
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			
			//grab result from database if successful
			$result = mysqli_stmt_get_result($stmt);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$passCheck = password_verify($password, $row['password']);
				if ($passCheck == false) {
					// dont allow the user to login if password is wrong
					header("Location: ../index.php?error=wrongpass");
					exit();
				} elseif ($passCheck == true) {
					// allow user to login
					session_start();
                    $_SESSION['sessionId'] = $row['id'];
                    $_SESSION['sessionUser'] = $row['username'];
					// redirect to successful login page
                    header("Location: ../index.php?success=loggedin");
                    exit();
				} else {
					header("Location: ../index.php?error=wrongpass");
					exit();
				}
			} else {
				header("Location: ../index.php?error=nouser");
				exit();
			}
		}
	}

} else {
	header("Location: ../index.php?error=accessforbidden");
	exit();
}
?>