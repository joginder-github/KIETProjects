<?php
	  require_once('connection.php');

	  session_start();
	  
      $v_id = $_SESSION['ID'];
	  
	  if(empty($v_id)){
		header("location:access-denied.php");
	  }

	  $qry = "SELECT * FROM `positions`;";
	  mysqli_query($con,$qry);
	  
	  
 
    //******************************************************************
 
    
  //    if (isset($_POST['vote']))
  //    {
       
  //      $position =  $_POST['position']; 
       
  //      $qry = "SELECT * FROM `candidates` WHERE `candidate_position`='$position';";
  //      $result2 = mysqli_query( $con,$qry );
  //      $count2 = mysqli_num_rows( $result2 );
       
	//  }
	 
	 
	   
	   if (isset($_GET['id']))
     {
		  // get id value
    $id 		= $_GET['id'];
	$pos        = $_GET['pos'];
	
    $query 		= "SELECT * FROM `vote` WHERE `voter_id` = '$v_id' AND `candidate_position` = '$pos'";
	$result3    = mysqli_query($con,$query);
	$row        = mysqli_fetch_array( $result3 );
	
		if($row['voter_id'] == $v_id && $row['candidate_position'] == $pos){
			
			echo '<div><h3 class="alert">You are Already vote for This Position!</h3></di>';
			
			
		}
       else{
		     $qry = "INSERT INTO `vote`(`candidate_id`,`voter_id`,`candidate_position`) VALUE('$id','$v_id','$pos');";
			 $result =  mysqli_query($con,$qry);
			 
			 
			 // redirect back to candidates
			 header("Location: vote.php");
	   }
	
    

     // delete the entry
     
     }
	   
     
    
  

	//**************************************************************************************//
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
//*************************************************************************
//*************************************************************************
 
    $qry2 = "SELECT * FROM `positions`";
	$positions_retrieved = mysqli_query($con,$qry2);
	$count	= mysqli_num_rows($positions_retrieved);
	
	
	
//*************************************************************************
//*************************************************************************
	
     



   
?>






<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">

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
        <li ><a href="voter.php">Home</a></li>
        <li><a href="manage-profile.php">Manage Profile</a></li>
        <li class="active"><a  href="vote.php">Vote</a></li>
        
        <li><a href="logout.php">Logout</a></li>
        

      </ul>
    </nav>
    
  </header>
</div>

<div >
<table width="380" align="center">
<CAPTION><h3>ADD NEW CANDIDATE</h3></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="vote.php" method="POST" onsubmit="return candidateValidate(this)">


<tr>
    <td bgcolor="#7FFFD4">Candidate Position</td>
    
    <td bgcolor="#7FFFD4">
		<SELECT name="position" id="position">select
			<OPTION VALUE="select">select
			<?php
				//loop through all table rows
				for($i=1;$i<=$count;$i++){
				$row= mysqli_fetch_array($positions_retrieved);
				  echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
				}
			?>
		</SELECT>
    </td>
</tr>
<tr>
    <td bgcolor="#BDB76B">&nbsp;</td>
    <td bgcolor="#BDB76B"><input type="submit" name="vote" value="vote" /></td>
</tr>
</table>
</form>

<?php
if (isset($_POST['vote']))
{
  
  $position =  $_POST['position']; 
  
  $qry = "SELECT * FROM `candidates` WHERE `candidate_position`='$position';";
  $result2 = mysqli_query( $con,$qry );
  $count2 = mysqli_num_rows( $result2 );
  




?>

<form method="POST" action="vote.php" >
<div>
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE CANDIDATES</h3></CAPTION>
<tr>

<th>Candidate Name</th>
<th>Candidate Position = <?php echo  $position; ?> </th>
</tr>
<?php
    //loop through all table rows
  
	for($i=1;$i<=$count2;$i++){
    $row= mysqli_fetch_array($result2);
	

    echo '<tr align="center">';
    echo "<td>" . $row['candidate_name']."</td>";
    echo '<td><a href="vote.php?id='. $row['candidate_id'].'&pos='.$row['candidate_position'].'" >Vote</a></td>';
    echo "</tr>";
    }
    

?>
</table>
<hr>
</div>
</form>
  <?php } ?>


<?php include('loginfooter.php')?>

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



