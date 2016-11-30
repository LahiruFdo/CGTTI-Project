<?php
	
	session_start();

	if(isset($_SESSION["section"])=="JO"){  
		include '../config.php';

		if(isset($_GET['id'])){
			$sectionCode = $_GET['id'];
			$con1 = new DatabaseCon($conn);
			$rslt = $con1->getConnection("SELECT name FROM section WHERE code = '$sectionCode'");
			$SecRow= $con1->getoutput($rslt);
			$section = $SecRow['name'];
		}

		else{
			header("Location:joboffice1.php");
		}
	}

	else{
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
	<link rel="stylesheet" type="text/css" href="../CSS/jo-home.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class = "page">
		<div class="page-area-1" style="font-family: 'calibri','verdana'; padding:2%;">
			<h1><i class="fa fa-building fa-lg"></i><span style="margin-left: 2%;"><?php echo $section." Section";?></span></h1>
		
			<div class="windowBttn" style="margin-top: 3%;">
				<b>Ongoing Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					
					$sql = "SELECT job_no,job_typ,rDate,tDate,contact_no,v_no FROM jobservce,customer WHERE ( jobservce.c_nic = customer.NIC AND jobservce.closedDate IS NULL AND jobservce.sec_code = '$sectionCode' ) ORDER BY rDate DESC";	//get the details of the ongoing jobs

					$con = new DatabaseCon($conn);

					if($result = $con->getConnection($sql)){
						$count = $con->getRowCount($result);
						if ($count >0){
							echo "<table><tr><th> Job No </th><th> Job Type </th><th> Registered Date </th><th> Vehicle No. </th><th> Target Date </th><th> Customer(Tele)</th>";//echo results in the table
							while($row= $con->getoutput($result)){
								$a = $row["job_no"]; $b=get_jt($row["job_typ"]); $c = $row["rDate"];  $d = $row["v_no"]; $e = $row["tDate"]; $f = $row["contact_no"];
								
						        echo 	"<tr><td><a href='JOviewjob.php?id=$a'>" . $a. 
						        		"</a></td><td><a href='JOviewjob.php?id=$a'>" . $b. 
						        		"</a></td><td><a href='JOviewjob.php?id=$a'>" . $c .
						        		"</a></td><td><a href='JOviewjob.php?id=$a'>" . $d .
						        		"</a></td><td><a href='JOviewjob.php?id=$a'>" . $e .
						        		"</a></td><td><a href='JOviewjob.php?id=$a'>" . $f .  
						        		"</a></td></tr>";
							}
							echo "</table>";
						}
						else {
					     	echo "No ongoing Jobs at the moment";
					    }
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>