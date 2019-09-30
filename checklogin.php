<?php
			ini_set ("display_errors", "1");
			error_reporting(E_ALL);
			ob_start();

			session_start();
			require_once('connection.php');

			// Defining your login details into variables
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];
			

			$encrypted_mypassword	=	md5($password); //MD5 Hash for security
			
			/*
			$email = stripslashes($email);
			$password = stripslashes($password);
			*/
			$sql = "SELECT * FROM `users` WHERE `email`='$email' and `password`='$encrypted_mypassword';";
			
			$result = mysqli_query($con,$sql);
			
			// Checking table row
			$count	=	mysqli_num_rows($result);
			// If username and password is a match, the count will be 1

			if($count==1){
				// If everything checks out, you will now be forwarded to voter.php
				$user = mysqli_fetch_assoc($result);
				
					$_SESSION['ID'] 		= $user['ID'];
					
				header("location:voter.php");
			}
			//If the username or password is wrong, you will receive this message below.
			else {
				echo "Wrong Username or Password<br><br>Return to <a href=\"login.php\">Login</a>";
			}

			ob_end_flush();

?> 


