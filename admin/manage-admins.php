<?php
				//If your session isn't valid, it returns you to the login screen for protection
				session_start();
				//echo $_SESSION['admin_id'];die;
				$id = $_SESSION['admin_id'];
				if(empty($_SESSION['admin_id'])){
				 	header("location:access-denied.php");
					
				}
				require('../connection.php');

				//Process
				if (isset($_POST['submit']))
				{

					$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
					$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
					$myEmail = $_POST['email'];
					$myPassword = $_POST['password'];

					$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

					$sql =  "INSERT INTO admin(first_name, last_name, email, password)
					VALUES ('$myFirstName','$myLastName', '$myEmail', '$newpass';";
					  
                    $result= mysqli_query($con,$sql);
                    mysqli_close();					
                     
					die( "A new administrator account has been created." );
				}
				//Process
				
				
				if (isset($_POST['submit']))
				{
					
					 $myFirstName	 = 	$_POST['first_name']; 
					 $myLastName	 =  $_POST['last_name']; 
					 $myEmail		 = 	$_POST['email'];
					 $myPassword 	 = 	$_POST['password'];

					$newpass = md5($myPassword); 

					$sql ="UPDATE `admin` SET `first_name`='$myFirstName', `last_name`='$myLastName', 
		                   `email`='$myEmail',`password`='$newpass' WHERE `admin_id` = '$id';";
					       
                    $status = mysqli_query($con,$sql);
					if($status == 1){
			    	echo "You have successfully registered for an account.<br><br>Go to <a href=\"login.php\">Login</a>" ;
			       }
		
					 else{
						 echo "Database connection error";
					 }
					 
					mysqli_close($con);
					echo  "An administrator account has been updated." ;
				}
			?>
<?php include('header.php') ?>



<?php include('footer.php'); ?>