<?php
	session_start();
	if(isset($_GET['searchItem'])){
		$input = $_GET['searchItem'];
		if($input == ""){
			header('location:JOvehicle.php');
		}
	}
	else{
		header('location:JOvehicle.php');
	}
?>
<!DOCTYPE html>
<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">\
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		<form action="JOview2.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:30%;">
		
			<div class="searchName" style="width:55%;">Search By Vehicle No.</div>
			<div class="searchBar" style="width:44%;"><input id="search" name="searchItem" type="text" placeholder="Enter Vehicle Number"/></div>
			
		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					if($input!=""){
						include '../config.php';
						
						$sql = "SELECT * FROM jobservce WHERE v_no LIKE '%$input%'";	
						
						if ($result = mysqli_query($conn,$sql)) {
							$count = mysqli_num_rows($result);
							if($count >0){
						    	echo "<table><tr><th> Vehicle No. </th><th> Job No. </th><th> Job Category </th><th> Owner </th><th> Registered Date </th><th> Status </th><th> Finished Date </th><th> GatePass No. </th></tr>";
						     	// output data of each row
						    	while($row = mysqli_fetch_assoc($result)) {
						    		$vNo = $row["v_no"];
							        $jobNo = $row['job_no'];
							        $c = $row["c_nic"];
							        $cus = $conn->query("SELECT name FROM customer WHERE NIC='$c'");
						        	$cname = $cus->fetch_assoc();
							        $gp = $conn->query("SELECT gtpass_no FROM account WHERE job_no='$jobNo'");
							        $gp = $gp->fetch_assoc();
							        if($gp==""){
							        	$gp="-";
							        }
							        $Status = $row["closedDate"];
							        if($Status==""){
							        	$dd = $conn->query("SELECT finished_date FROM job WHERE job_no='$jobNo'");
							        	$dd1 = $dd->fetch_assoc();
							        	if($dd1['finished_date']==""){
							        		$state = "Unfinished";
							        	}
							        	else{
							        		$state = "Finished";
							        	}						        	
							        	$Status="-";
							        }
							        else{
							        	$state = "Closed";
							        }
							        echo "<tr><td>" . $row["v_no"]. "</td><td>" . $row["job_no"]. "</td><td>" . get_jt($row["job_typ"]). "</td><td>" . $cname["name"]. "</td><td>" . $row["rDate"] . "</td><td>".$state."</td><td>".$Status."</td><td>".$gp."</td></tr>";
							   	}
						     	echo "</table>";}
						 	else {
						     	echo "No search results are existing";
						    }
						}
					}
				?>
			</div>	
		</div>
	</div>
</body>
</html>