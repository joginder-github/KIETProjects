<?php

	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['admin_id'])){
	 header("location:access-denied.php");
	}
	
require_once('../connection.php');
// retrieving candidate(s) results based on position
// if (isset($_POST['submit'])){   

	// $position =  $_POST['position'] ;
    // $qry = "SELECT * FROM `candidates` WHERE `candidate_position`='$position';";
	// $results = mysqli_query($con,$qry);
	

    // $row1 = mysqli_fetch_array($results); // for the first candidate
    // $row2 = mysqli_fetch_array($results); // for the second candidate
	
      // if ($row1){
      // $candidate_name_1		=	$row1['candidate_name']; // first candidate name
      // $candidate_1			=	$row1['candidate_cvotes']; // first candidate votes
      // }

      
	  
	     
		 
//}        
           


   
   if(isset($_POST['submit'])){
	   
	   //************************************************************
	   
	   
	       $position    =  $_POST['position'];
		   
           $total_count = "SELECT COUNT(*) AS total 
						  FROM `vote` 
					      WHERE `candidate_position` = '$position';";
					
		   $t_c 	    = mysqli_query( $con, $total_count );	
		   $t_value     = mysqli_fetch_assoc( $t_c );
		   $t_num_row   = $t_value['total'];
		   
	      
	   
	   
	   //*************************************************************
	  
	   $qry 		 = "SELECT * FROM `candidates` WHERE `candidate_position`='$position';";
	   $results 	 = mysqli_query($con,$qry);
	   $count 		 = mysqli_num_rows($results);
	   //echo $count;die;
	   for($i=1;$i<=$count;$i++){
		   
		   $row  = mysqli_fetch_array($results);
		   $c_id = $row['candidate_id'];
		  

		  
		   $c_query    = "SELECT COUNT(*) AS total 
						  FROM `vote` 
					      WHERE `candidate_id` = '$c_id';";
					
		   $c 		   = mysqli_query( $con, $c_query );	
		   $value      = mysqli_fetch_assoc( $c );
		   $num_row    = $value['total'];
		   
		   
		   
		   
		   $qry2    = "UPDATE `candidates` SET `candidate_cvotes` = '$num_row' WHERE candidate_id = '$c_id';";
		   $result2 = mysqli_query( $con,$qry2 );
	   
	   }
	   
	  
		   $qry3 		=  "SELECT * FROM `candidates` WHERE `candidate_position`= '$position'";
		   $result3 	=  mysqli_query( $con,$qry3 );
		   $count3  	=  mysqli_num_rows( $result3 );
	   
	   
       
  }
  $qu 	= "SELECT * FROM `positions`";
  $res	= mysqli_query( $con,$qu );
  $co 	= mysqli_num_rows( $res );
   

?>


<?php include('header.php');?>

<div >
 
  <div >
    <table width="420" align="center">
    <form name="fmNames" id="fmNames" method="POST" action="refresh.php" onSubmit="return positionValidate(this)">
    <tr>
        <td style="color:#000000";>Choose Position</td>
        <td><SELECT name="position" id="position">
        <OPTION  VALUE="select"><p style="color:black";>select</p>
        <?php 
        //loop through all table rows
		for ($i=1;$i<=$co;$i++){
        $row= mysqli_fetch_array($res);
          echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
        }
        ?>
        </SELECT></td>
        <td style="color:black";><input type="submit" name="submit" value="See Results" /></td>
    </tr>
    <tr>
     
        
    </tr>
    </form> 
    </table>
    <?php if(isset($_POST['submit'])){
		
			for( $i = 1; $i <= $count3; $i++ ){
		   
		   $row  	=  mysqli_fetch_array( $result3 );
		   
		   // echo $row['candidate_id'];
		   // echo $row['candidate_name'];
		   //echo $row['candidate_cvotes']."<br />";
			?>
			
			
	
				<img src="images/candidate-1.gif" 
				style="height:<?php echo(100*round($row['candidate_cvotes']/($t_num_row),2));  ?>px;width:10px" >
				 
				<?php echo(100*round($row['candidate_cvotes']/( $t_num_row ),2)); ?>% of <?php echo $t_num_row; ?> total votes
                <br><?php  echo $row['candidate_name']; ?>&nbsp;votes = <?php echo $row['candidate_cvotes']; ?>
                <br>
				<br>
				<br>
			
			<?php
	   }
	      
			} 
	?>
	
	
    
  
  
  </div>

</div>

<?php include('footer.php');?>


