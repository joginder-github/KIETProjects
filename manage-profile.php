<?php
    session_start();
    require('connection.php');

    //If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['ID'])){
      header("location:access-denied.php");
    } 
	$id = $_SESSION['ID'];
    //retrive voter details from the tbmembers table
	
	
	
	if(isset($_POST['upload'])){
	
		
		$img_name  	= $_FILES['profile']['name'];
		
		$tmp_name 	= $_FILES['profile']['tmp_name'];
		
			
			
		 
		$file_ext_ex	 = explode('.',$img_name);
		$file_ext 		 = strtolower(end($file_ext_ex));
		$destination 	 = 'profiles/'.$img_name;
		$ext_array 		 = array('jpg','png','jpeg');
		
		
		if(in_array($file_ext,$ext_array)){
			
			move_uploaded_file($tmp_name,'profiles/'.$img_name);
			
			$qry 	=  "UPDATE `users` SET `img`='$destination' WHERE `id` = $id";
 
		//	print_r($qry);die;
			$result =   mysqli_query($con,$qry);
			
			
		}
		else{
			echo '<div class="alert alert-danger">Please Upload a valid Image Format ,
							  valid image format is .jpg, .jpeg and .png</div>';
	}}
	
	
	$qry 	= "SELECT * FROM users WHERE ID = '$id';";
	$result	= mysqli_query($con,$qry);
	
   
    $row = mysqli_fetch_array($result);
	
    if($row)
     {
         // get data from db
         $id 			= $row['ID'];
         $first_name 	= $row['first_name'];
         $last_name 	= $row['last_name'];
         $email 		= $row['email'];
         $city 			= $row['city'];
         $voter_id 		= $row['voter_id'];
		 $gender		= $row['gender'];
		 $password	    = $row['password'];
		 
     }

    // updating sql query
    if (isset($_POST['submit'])){
		
			//$my_Id 			= $_POST['id'];
			$my_firstname 	= $_POST['first_name']; 
			$my_lastName 	= $_POST['last_name'] ; 
			$my_email 		= $_POST['email'];
			$my_city 		= $_POST['city'];
			$my_password 	= $_POST['password'];
			$my_voterid 	= $_POST['voter_id'];
			$my_gender      = $_POST['gender'];

			$newpass 		= md5($my_password); //This will make your password encrypted into md5, a high security hash

        if($newpass == $password){

			$sql = "UPDATE `users` SET `first_name`='$my_firstname', `last_name`='$my_lastName', 
			`email`='$my_email', `voter_id` = '$my_voterid',`city` ='$my_city',`gender`='$my_gender',
			`password`='$newpass' WHERE `ID` = '$id';";
			
		}else{

			echo "<script type='text/javascript'>
					alert('Incorect Password.');
					window.location='http://localhost/evote/manage-profile.php';
			
			</script>";
		}
		  
		$result = mysqli_query($con,$sql);
		mysqli_close($con);

        
    }
?>
 
<!DOCTYPE html>
<html>
	<head>
		<title>online voting</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  		<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
		<script language="JavaScript" src="js/user.js"></script>
		<style> 
			#fdiv,#sdiv{
				float:left;
			}
			#file,#file2{
				float:left;
			}
		</style>
	</head>
	<body id="top" style="background-color:rgb(247, 244, 247);">
	  
		<div class="wrapper row0">
			<div id="topbar" class="hoc clear">
				<div class="fl_left">
					<ul class="faico clear">
						<li><a class="faicon-facebook" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
						<li><a class="faicon-pinterest" href="https://uk.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
						<li><a class="faicon-twitter" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
						<li><a class="faicon-dribble" href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a></li>
						<li><a class="faicon-linkedin" href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
						<li><a class="faicon-google-plus" href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
						<li><a class="faicon-rss" href="https://www.rss.com/"><i class="fa fa-rss"></i></a></li>
					</ul>
				</div>
				<div class="fl_right">
					<ul class="nospace inline pushright">
						<li><i class="fa fa-phone"></i> +91-8090875239</li>
						<li><i class="fa fa-envelope-o"></i> lko.jetking.joginder@gmail.com </li>
					</ul>
				</div>
			</div>
		</div>
		<div class="wrapper row1">
			<header id="header" class="hoc clear">
				<div id="logo" class="fl_left">
					<h1><a href="index.html">ONLINE VOTING</a></h1>
				</div>
				<nav id="mainav" class="fl_right">
					<ul class="clear">
						<li><a href="voter.php">Home</a></li>
						<li><a class="active" href="manage-profile.php">Manage Profile</a></li>
						<li><a href="vote.php">Vote</a></li>
						<li><a href="logout.php">Logout</a></li>
			
					</ul>
				</nav>
			</header>
		</div>
		<div class="wrapper bgded " style="padding-left:140px;" >
			<section id="testimonials" class="hoc container clear">
			
			
			<div class="container">
				<h1 class="display-4">Upload Profile Picture</h1>
					  <div class="jumbotron">
						   
							<form action="manage-profile.php" method="POST"  enctype="multipart/form-data">
								
								<input type="file" name="profile" id="file">
								<input type="submit" class="btn btn-primary" value="Upload Image" name="upload" id="file2">
							</form>
					  </div>      
		    </div>
			
			
			<!--**************************************************************-->
				<div class="container col-md-6" id="fdiv" style="margin-top:50px;"  >
					
					<table class="table table-striped table-hover">
						
						<tbody>
							<tr>
								<th>Name</th>
								<td><?php echo $first_name." ".$last_name; ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $email;?></td>
							</tr>
							<tr>
								<th>City</th>
								<td><?php echo $city; ?></td>
							</tr>
							<tr>
								<th>voter ID</th>
								<td><?php echo $voter_id; ?></td>
							</tr>
							<tr>
								<th>Gender</th>
								<td><?php echo $gender; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="container col-md-6"    id="sdiv">
					<form action="manage-profile.php" method="POST">
						<div class="form-group">
							<label for="email">First Name:</label>
							<input type="text" class="form-control" id="email" placeholder="Enter first name" name="first_name" value="<?php echo $first_name; ?>">
						</div>
						<div class="form-group">
							<label for="pwd">Last name:</label>
							<input type="text" class="form-control" id="pwd" placeholder="Enter last name" name="last_name" value="<?php echo $last_name; ?>">
						</div>
						<div class="form-group">
							<label for="pwd">Email:</label>
							<input type="email" class="form-control" id="pwd" placeholder="Enter email" name="email" value="<?php echo $email; ?>">
						</div>
						<div class="form-group">
							<label for="pwd">city:</label>
							<input type="text" class="form-control" id="pwd" placeholder="Enter city" name="city" value="<?php echo $city; ?>">
						</div>
						<div class="form-group">
							<label for="pwd">Voter ID:</label>
							<input type="text" class="form-control" id="pwd" placeholder="Enter voter ID" name="voter_id" value="<?php echo $voter_id; ?>">
						</div>
						
						<div class="form-group">
							<label class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" value="male" <?php if($gender=='male'){echo 'checked';} ?>>
							<span class="form-check-label"> Male </span>
							</label>
							<label class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="gender" value="female" <?php if($gender=='female'){echo 'checked';} ?>>
							<span class="form-check-label"> Female</span>
							</label>
						</div>
						
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password1">
						</div>
						<div class="form-group">
							<label for="pwd">Confirm Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
						</div>
						<input type="submit" class="btn btn-primary" value="submit" name="submit">
					</form>
				</div>
			</section>
			
		</div>
		
		
		<!--***********************************************************************-->
		<?php include('loginfooter.php')?>