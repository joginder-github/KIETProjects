<?php
  	
  	//Process
  	if (isset($_POST['submit']))
  	{

  		$first_name = $_POST['first_name']; 
  		$last_name  = $_POST['last_name'];  
  		$email 		= $_POST['email'];
		$gender		= $_POST['gender'];
		$city		= $_POST['city'];
  		$voter_id 	= $_POST['voter_id'];
  		$password 	= $_POST['password'];
  		$confirm_password 	= $_POST['confirm_password'];

  		$newpass = md5($confirm_password); //This will make your password encrypted into md5, a high security hash
      
		require('connection.php');

		$check_email_query = "select `email` from users where `email`='$email'";

		$check_email = mysqli_query($con,$check_email_query);

		

		if( mysqli_num_rows ( $check_email ) == 0){

			$qry = "INSERT INTO users(`first_name`, `last_name`, `email`, `gender`, `city`, `voter_id`,`password`) VALUES ('$first_name','$last_name', '$email','$gender','$city','$voter_id', '$newpass');";
  		 
		}

		else {
			
			echo "<script type='text/javascript'>
					alert('Email already exists, please use another Email.');
					window.location='http://localhost/evote/registration.php';
			
			</script>";
			
		}

		if($password == $confirm_password ){	
		
		$status = mysqli_query($con,$qry);
		
		}
		else{
			echo '<script>alert("Password and Confirm Password did not match!");</script>';
		}
		
		 if($status == 1){
				echo '<div class="container">
							<div class="alert alert-success">
								<strong>Success</strong>You have successfully registered for an account.<br><br>Go to <a href="login.php">Login</a>
							</div>
					</div>' ;
			}
		
		 
		 
		mysqli_close($con);
  	}

  	echo "<center><h3>Register an account by filling in the needed information below:</h3></center>";
  	    
  ?>
  
  
  
<?php include('header.php') ?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
<br>  <p class="text-center">Go to Home Page <a href="index.php"> E-Vote</a></p>
<hr>


<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
	<h4 class="card-title mt-2">Sign up</h4>
</header>
<article class="card-body">
<form method="POST" action="#">
	<div class="form-row">
		<div class="col form-group">
			<label>First name </label>   
		  	<input type="text" class="form-control" placeholder="" name="first_name">
		</div> <!-- form-group end.// -->
		<div class="col form-group">
			<label>Last name</label>
		  	<input type="text" class="form-control" placeholder=" " name="last_name" >
		</div> <!-- form-group end.// -->
	</div> 
	
	<!-- form-row end.// -->
	
	<div class="form-group">
		<label>Email address</label>
		<input type="email" class="form-control" placeholder="" name="email" >
		<small class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>

	<!-- form-group end.// -->
	
	<div class="form-group">
			<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="male">
		  <span class="form-check-label"> Male </span>
		</label>
		<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="female">
		  <span class="form-check-label"> Female</span>
		</label>
	</div>
	<!-- form-group end.// -->
	
	<div class="form-row">
		<div class="form-group col-md-6">
		  <label>City</label>
		  <input type="text" class="form-control" name="city" >
		</div> <!-- form-group end.// -->
		
		
		<div class="form-group col-md-6">
		  <label>Voter ID</label>
		  <input type="text" class="form-control" name="voter_id" >
		</div> <!-- form-group end.// -->
		
	</div> <!-- form-row.// -->
	
	
	<div class="form-group">
		<label>Create password</label>
	    <input class="form-control" type="password" name="password" >
	</div> <!-- form-group end.// -->  
	
	<div class="form-group">
		<label>confirm password</label>
	    <input class="form-control" type="password" name="confirm_password" >
	</div> <!-- form-group end.// -->  
	
	
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Register"> 
    </div> <!-- form-group// -->  
	
    
    <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>                                          
</form>
</article> <!-- card-body end .// -->
<div class="border-top card-body text-center">Have an account? <a href="login.php">Log In</a></div>
</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->


</div> 
<!--container end.//-->

<br><br>
<?php include('footer.php'); ?>
