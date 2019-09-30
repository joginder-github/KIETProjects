<?php
	require('connection.php');

	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['ID'])){
	 	header("location:access-denied.php");
	}
	$id 	= $_SESSION['ID'];
	$qry 	= "select * FROM `users` WHERE ID = '$id';";
	
	$result = mysqli_query($con, $qry);
	$count	= mysqli_num_rows($result);
	
	if($count==1){
				
				$user = mysqli_fetch_array($result);
				$first_name = $user['first_name'];
				$last_name  = $user['last_name'];
				$email      = $user['email'];
				$voter_id   = $user['voter_id'];
				$city		= $user['city'];
				$gender     = $user['gender'];
				$img		= $user['img'];			
				
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
		<h1 class="display-4" style="text-align:center;margin-top:30px;"><?php echo $first_name." ".$last_name; ?></h1><hr/>
		<div class="wrapper bgded " style="padding-left:170px; " >
			<section id="testimonials" class="hoc container clear">
			
			
			<!--***********************************************************************-->
			
  
				
			

			<div class="container col-md-6" id="fdiv" style="margin-top:30px;">
           
				  <table class="table table-hover table-striped ">
					
					<tbody>
					  <tr>
						<th>Name</th>
						<td><?php echo $first_name." ".$last_name; ?></td>
					  </tr>
					  
					  <tr>
						<th>Email</th>
						<td><?php echo $email; ?></td>
					  </tr>
					  
					  <tr>
						<th>City</th>
						<td><?php echo $city; ?></td>
					  </tr>
					  
					  <tr>
						<th>Voter ID</th>
						<td><?php echo $voter_id; ?></td>
					  </tr>

					  <tr>
						<th>Gender</th>
						<td><?php echo $gender; ?></td>
					  </tr>
					  
					</tbody>
				  </table>
           </div>
			
			
			
		<div class="container col-md-4" id="sdiv" style="margin-left:30px;">
			<img src="<?php echo $img; ?>" class="img-rounded" id="contain" alt="No Image" style="width:300px;height:300px;" > 
		</div>
		
			
			
			
			
			
			
			
			<!--***********************************************************************-->	
			</section>
		</div>
		
		
		<?php include('admin/footer.php');?>
		<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
		<!-- JAVASCRIPTS -->
		<script src="layout/scripts/jquery.min.js"></script>
		<script src="layout/scripts/jquery.backtotop.js"></script>
		<script src="layout/scripts/jquery.mobilemenu.js"></script>
		<!-- IE9 Placeholder Support -->
		<script src="layout/scripts/jquery.placeholder.min.js"></script>
		<!-- / IE9 Placeholder Support -->
	</body>
</html>
