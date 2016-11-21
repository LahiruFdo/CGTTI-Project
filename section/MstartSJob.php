<?php 

session_start();
  	include_once '../config.php';  
		$sjobNo = $_POST['sjNo'];
        $strtDate = date("Y-m-d");
	    $manHr = 0;
	    $machHr = 0; 
   	$sql="UPDATE subjob set start_date='$strtDate' , man_hrs='$manHr' , mach_hrs='$machHr' where subjob_no='$sjobNo'";
    $rst=mysqli_query($conn,$sql);
	header('Location:section.php');
    
?>