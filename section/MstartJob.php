<?php 

	session_start();
	include_once '../config.php';  
			$jobNo = $_POST['jNo'];
	        $strtDate = date("Y-m-d");
	        $manHr = 0;
	        $machHr = 0; 
	$sql="UPDATE job set start_date='$strtDate' , man_hrs='$manHr' , mach_hrs='$machHr' where job_no='$jobNo'";
	$rst=mysqli_query($conn,$sql);
	header('Location:section.php');
    
?>