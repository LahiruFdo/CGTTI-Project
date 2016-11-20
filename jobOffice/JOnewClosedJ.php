<?php
	session_start();
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
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		<div class="searchResults">
			<div class="windowBttn">
				<b>New Completed Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					$num1 = 0;
					$num2 = $num1+10;
					include '../config.php';
					$sql = "SELECT * FROM jobservce WHERE closedDate IS NOT NULL ORDER BY closedDate DESC LIMIT $num1,$num2 ";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Section </th><th> Job Category </th><th> Registered Date </th><th> Closed Date </th><th> GatePass No. </th></tr>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];
						    	$scode = $row["sec_code"];
						        $section = $conn->query("SELECT name FROM section WHERE code='$scode'");
						        $sec = $section->fetch_assoc();
						        $jn = $row["job_no"];
						        $gp = $conn->query("SELECT gtpass_no FROM account WHERE job_no='$jn'");
						        $gp = $gp->fetch_assoc();
						        $gp = $gp['gtpass_no'];
						        
						        echo "<tr><td><a href='JOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $sec["name"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["job_typ"]. "</a></td><td><a href='JOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='JOviewjob.php?id=$a'>".$row["closedDate"]."</td><td><a href='JOviewjob.php?id=$a'>".$gp."</td></tr>";
						   	}
					     	echo "</table>";
					     	if($count==10){echo "<div class='links'><a href='JOview.php?id=$num2'><u>View More</u></a></div>";}}
					 	else {
					     	echo "<center>No new finished Jobs at the moment</center>";
					    }
					}
				?>

			</div>	
		</div>
	</div>
</body>
</html>