<?php
    session_start();
    require('../connection.php');
    if(empty($_SESSION['admin_id'])){
      header("location:access-denied.php");
    } 
    $qry= "SELECT * FROM `candidates`";
	$result = mysqli_query($con,$qry);
	$count2 = mysqli_num_rows($result);
	
	
	//************************************************************//
    
    $qry2 = "SELECT * FROM `positions`";
	$positions_retrieved = mysqli_query($con,$qry2);
	$count	= mysqli_num_rows($positions_retrieved);
    
    //************************************************************//
	
	
	if (isset($_POST['submit']))
	{

		$newCandidateName 		=  $_POST['name']; 
		$newCandidatePosition   =  $_POST['position']; 
		

		$sql =  "INSERT INTO `candidates`(`candidate_name`,`candidate_position`) VALUES ('$newCandidateName','$newCandidatePosition');";
		$result = mysqli_query($con,$sql);
		
        
		// redirect back to candidates
		 header("Location: candidates.php");
		}
    
	
	//***********************************************************//
    // deleting sql query
    // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
     // get id value
     $id = $_GET['id'];
     
     // delete the entry
     $qry = "DELETE FROM `candidates` WHERE `candidate_id`='$id';";
	 $result =  mysqli_query($con,$qry);
     
     
     // redirect back to candidates
     header("Location: candidates.php");
     }
     else
     // do nothing   
?>






<?php include('header.php'); ?>

<div >
<table width="380" align="center">
<CAPTION><h3>ADD NEW CANDIDATE</h3></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="candidates.php" method="POST" onsubmit="return candidateValidate(this)">
<tr>
    <td bgcolor="#FAEBD7">Candidate Name</td>
    <td bgcolor="#FAEBD7"><input type="text" name="name" /></td>
</tr>

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
    <td bgcolor="#BDB76B"><input type="submit" name="submit" value="Add" /></td>
</tr>
</table>
</form>


<form method="POST" action="candidates.php" >
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE CANDIDATES</h3></CAPTION>
<tr>
<th>Candidate ID</th>
<th>Candidate Name</th>
<th>Candidate Position</th>
</tr>

<?php
    //loop through all table rows
	for($i=1;$i<=$count2;$i++){
    $row= mysqli_fetch_array($result);
    echo "<tr>";
    echo "<td>" . $row['candidate_id']."</td>";
    echo "<td>" . $row['candidate_name']."</td>";
    echo "<td>" . $row['candidate_position']."</td>";
    echo '<td><a href="candidates.php?id=' . $row['candidate_id'] . '">Delete Candidate</a></td>';
    echo "</tr>";
    }
    
?>

</table>
<hr>
</div>



<?php include('footer.php'); ?>