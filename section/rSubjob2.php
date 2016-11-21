<?php
	session_start();
	$sec_code = $_SESSION["section"];
	if(isset($_GET['searchItem'])){
		$input = $_GET['searchItem'];
		if($input == ""){
			header('location:rSubjob.php');
		}
	}
	else{
		header('location:rSubjob.php');
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
		<form action="rSubjob2.php" method="GET">
		<div class="search-button"><button id="b" type="submit">GO</button></div>
		<div class="search" style="width:27%;">
		
			<div class="searchName" style="padding-top:2.4%;">Search By Job No.</div>
			<div class="searchBar"><input id="search" name="searchItem" type="text" placeholder="Enter Job Number Here"/></div>

		</div>
		</form>
		<div class="searchResults">
			<div class="profInfo">
				<?php
					$sql = "SELECT job_typ, job.job_no, subjob.subjob_no, subjob.rDate, subjob.finish_date, subjob.fr  FROM job, subjob, jobservce WHERE ( job.job_no = jobservce.job_no AND job.job_no = subjob.job_no AND subjob.t = '$sec_code' AND subjob.start_date IS NOT NULL AND job.job_no LIKE '%$input%') ORDER BY subjob.start_date DESC";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Job Category </th><th> Sub-Job No </th><th> Section </th><th> Recieved Date </th><th> Status </th></tr>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["subjob_no"];
						        $jn = $row["fr"];

						        $s = "SELECT name FROM section WHERE code='$jn'";
						        $s = mysqli_query($conn,$s);
						        $ss = mysqli_fetch_assoc($s);
						        $ss = $ss['name'];

						        $dd = $row['finish_date'];

						        
						        if($dd==""){
						        	$state = "Unfinished";
						        }
						        else{$state = "Finished";}
						  
						  		if($state == "Finished"){
						  			echo "<tr><td><a href='rCsjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='rCsjob.php?id=$a'>" . get_jt($row["job_typ"]). "</a></td><td><a href='rCsjob.php?id=$a'>" . $row["subjob_no"] . "</a></td><td><a href='rCsjob.php?id=$a'>" . $ss . "</a></td><td><a href='rCsjob.php?id=$a'>".$row["rDate"]."</td><td><a href='rCsjob.php?id=$a'>".$state."</td></tr>";
						  		}
						  		else{
						  			echo "<tr><td><a href='MOJOviewSjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . get_jt($row["job_typ"]). "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $row["subjob_no"] . "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $ss . "</a></td><td><a href='MOJOviewSjob.php?id=$a'>".$row["rDate"]."</td><td><a href='MOJOviewSjob.php?id=$a'>".$state."</td></tr>";
						  		}
						    
						   	}
					     	echo "</table>";
					    }
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


