<?php
	session_start();
	$sec_code = $_SESSION["section"];
	if (!isset($_GET['id'])){
    	$num = 0;
	}
	else{
		$num = $_GET['id'];
	}
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		<form action="viewAll2.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:27%;">
		
			<div class="searchName" style="padding-top:2.4%;">Search By Job No.</div>
			<div class="searchBar"><input id="search" name="searchItem" type="text" placeholder="Enter Job Number Here"/></div>

		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					$num1 = $num;
					$num2 = $num1+10;
					$sql = "SELECT start_date, finished_date, rDate, job_typ, job.job_no FROM job, jobservce WHERE ( job.job_no = jobservce.job_no AND jobservce.sec_code = '$sec_code') ORDER BY job.start_date DESC LIMIT $num1,10 ";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Job Category </th><th> Registered Date </th><th> No. of Sub-Jobs </th><th> Status </th><th> Started Date </th><th> Finished Date </th></tr>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						        $jn = $row["job_no"];
						        $sc = $conn->query("SELECT subJob_no, COUNT(*) AS 'total' FROM subjob WHERE job_no = '$a' GROUP BY subJob_no");
						        $sc = $sc->fetch_assoc();
						        $sc = $sc['total'];
						        if($sc==""){
						        	$sjc="0";
						        }
						        else{$sjc = $sc;}
						        $Status = $row["finished_date"];
						        $std = $row["start_date"];
						        if($Status==""){
						        	if($row["start_date"]==""){
						        		$state = "Not Started";
						        		$std = "-";
						        	}
						        	else{
						        		$state = "Unfinished";
						        	}
						        	$Status="-";
						        }
						        else{$state = "Finished";}
						  
						  		if($state == "Finished"){
						  			echo "<tr><td><a href='viewCjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='viewCjob.php?id=$a'>" . get_jt($row["job_typ"]). "</a></td><td><a href='viewCjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='viewCjob.php?id=$a'>".$sjc."</td><td><a href='viewCjob.php?id=$a'>".$state."</td><td><a href='viewCjob.php?id=$a'>" . $std . "</a></td><td><a href='viewCjob.php?id=$a'>" . $Status . "</a></td></tr>";
						  		}
						  		else{
						  			echo "<tr><td><a href='MOJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . get_jt($row["job_typ"]). "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='MOJOviewjob.php?id=$a'>".$sjc."</td><td><a href='MOJOviewjob.php?id=$a'>".$state."</td><td><a href='MOJOviewjob.php?id=$a'>" . $std . "</a></td><td><a href='viewCjob.php?id=$a'>" . $Status . "</a></td></tr>";
						  		}
						    
						   	}
					     	echo "</table>";
					     	if($count==10){echo "<div class='links'><a href='viewAll.php?id=$num2'><u>View More</u></a></div>";}}
					 	else {
					     	echo "<center>No more Jobs</center>";
					    }
					}
				?>

			</div>	
		</div>
	</div>
</body>
</html>


