<?php
	session_start();
	
	
	
	if( empty($_SESSION['admin_id']) ){
		
	   header("location:access-denied.php");
	}
	require('../connection.php');
	$qry = "SELECT * FROM `positions`";
	
	$result = mysqli_query($con,$qry);
	$count	= mysqli_num_rows($result);
	
	
	
	
	
	if (isset($_POST['Submit']))
	{

	$newPosition =  $_POST['position']; //prevents types of SQL injection

	//$sql = "INSERT INTO tbPositions(position_name) VALUES ('$newPosition');";
	$sql = "INSERT INTO `positions`(`position_name`) VALUES ('$newPosition');";
	$result = mysqli_query($con,$sql);       
     mysqli_close($con);
	// redirect back to positions
	   header("Location: positions.php");
	}
?>
<?php
	// deleting sql query
	// check if the 'id' variable is set in URL
	 if (isset($_GET['id']))
	 {
	 // get id value
	 $id = $_GET['id'];
	 
	 
	 // delete the entry
	  $qry ="DELETE FROM `positions` WHERE `position_id`='$id';";
	  $result = mysqli_query($con,$qry);
	  mysqli_close($con);
	 
	 // redirect back to positions
	 header("Location: positions.php");
	 }
	 else
	 // do nothing
    
?>


<?php include('header.php'); ?>

<div >
	<table width="380" align="center">
	<CAPTION><h3>ADD NEW POSITION</h3></CAPTION>
	<form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return positionValidate(this)">
	<tr>
	    <td bgcolor="#00ff80">Position Name</td>
	    <td bgcolor="#808080"><input type="text" name="position" /></td>
	    <td bgcolor="#00FF00"><input type="submit" name="Submit" value="Add" /></td>
	</tr>
	</table>

	<table border="0" width="420" align="center">
		<CAPTION><h3>AVAILABLE POSITIONS</h3></CAPTION>
		<tr>
		<th>Position ID</th>
		<th>Position Name</th>
		</tr>

		<?php
			//loop through all table rows
			for($i=1;$i<=$count;$i++)
			 {
			$row = mysqli_fetch_array($result);
			echo "<tr>";
			echo "<td>" . $row['position_id']."</td>";
			echo "<td>" . $row['position_name']."</td>";
			echo '<td><a href="positions.php?id=' . $row['position_id'] . '">Delete Position</a></td>';
			echo "</tr>";
			}
			
			mysqli_close($con);
		?>

	</table>
	<hr>
</div>



<?php include('footer.php'); ?>