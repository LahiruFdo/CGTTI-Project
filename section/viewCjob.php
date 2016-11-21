<?php
	include '../config.php';
	session_start();
	$seccode = $_SESSION['section'];

	/*function get_jt($j){
		$type = "Private Job";
		switch($j){
			case "BJ": $type = "Bus Jobs"; break;
			case "VM": $type = "Vehicle Maintain"; break;
			case "M": $type = "Institute Maintainance"; break;
			case "TRG": $type = "Training (Full Time)"; break;
			case "PRG": $type = "Training (Part Time)"; break;
			case "PR": $type = "Production"; break;
			case "STC": $type = "Special Training Course"; break;
			case "VTI": $type = "Borella Institute"; break;
			case "DP": $type = "Director Bunglow"; break;
		}
		return $type;
	}*/

	if (!isset($_GET['id'])){
    	echo 'No ID was given...';
    	exit;
	}
	else{
		$jobNo = $_GET['id'];

		$sql1 = mysqli_query($conn,"SELECT * FROM jobservce WHERE job_no = '$jobNo'");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
		$jt = get_jt($row1['job_typ']);
		$code = $row1['sec_code'];
		$cDate = $row1['closedDate'];
		$gp = $row1['gatePass'];

		if($cDate==""){
			$status = "Unfinished";
		}
		else if($gp==""){
			$status = "Finished";
		}
		else{
			$status = "Closed";
		}

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name'];
		$rDate = $row1['rDate'];
		$det = $row1['details'];

		$sql3 = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE job_no = '$jobNo'");
		$sj = mysqli_num_rows($sql3);

		$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$jobNo'");
		$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
		$vNo= $row4['v_no'];

		$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
		$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);

		$sql6 = mysqli_query($conn,"SELECT gtpass_no FROM account WHERE job_no = '$jobNo'");
		$row6 = mysqli_fetch_array($sql6, MYSQL_ASSOC);
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea">
		<div class="titleArea">
			<div class="theme"><h1>Job No. :- <span class="Number"><?php echo $jobNo; ?><div class="status"><?php echo "<mark>( Status : Finished )</mark>"; ?></div></span></h1></div>

		</div>
		<div class="form-area" style="background-color:#fff; height:auto; width:43.5%;margin-top:0%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Job Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1">Job Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $jt; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Registered Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $rDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $det; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Sub Job No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1">
				<?php 
						if($sj == 0){
							echo "---";
						}
						else{
						while($sj>0){
							$row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);
							$sj = $row3['subJob_no'];
							echo "<a href=viewSubjob.php?id=$sj><b>".$row3['subJob_no']."</b></a>";
							$sj = $sj-1;
						}}
				?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Finished Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1">
				<?php 
						if($cDate == ""){
							echo "---";
						}
						else{
							echo $cDate;
						}
				?>
				</div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="padding-bottom:2%;">GatePass No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1">
				<?php 
						if($gp == "F"){
							echo "---";
						}
						else{
							echo $row6['gtpass_no'];
						}
				?>
				<br><br><br>
				</div></dd>
			</div><br>
			</dl>
		</div>
		<div class="form-area" style="background-color:#fff; height:auto; width:38%;margin-top:0%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Other Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Customer Name</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['name']; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Vehicle No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $vNo ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Contact No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['contact_no'] ?></div></dd>
			</div><br>
			<div class="list">--------------------------------------------------------------------------------</div>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;padding-top:1%;">Email</div><div class="form-dots2" style="padding-top:1%;">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;padding-top:1%;"><?php echo $row5['email'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Address</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row5['address'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Fuel Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['fuel_typ'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;">Engine No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['eng_no'] ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:35%;padding-bottom:2%;">Chassis No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:60%;"><?php echo $row4['che_no'] ?></div></dd>
			</div><br>
			</dl>
		</div>
		<div id = "g1" class="button-action1"><p>Send Message to</p><p>the Job Office</p></div>
		<a href="#" style="text-decoration: none; color:black"><div id = "b1" class="round-button1">
			<img src="../images/mesg.png" style="width:60%; height:80%; margin-top:5%; margin-left:20%; ">
		</div></a>
		<a href="JobDetails(PDF).php?id=<?php echo $jobNo; ?>" target="_blank" style="text-decoration: none; color:black"><div id = "b2" class="round-button2"><img src="../images/download.png" style="width:80%; height:75%; margin-top:5%; margin-left:10%; "></div></a>
		<div id = "g2" class="button-action1" style="margin-top:18%"><p>Download Details</p></div><br>
		<script type="text/javascript">
			var event1 = document.getElementById('b1');
			var event2 = document.getElementById('b2');
			event1.onmouseover = function() {
			  document.getElementById('g1').style.display = 'block';
			}
			event1.onmouseout = function() {
			  document.getElementById('g1').style.display = 'none';
			}
			event2.onmouseover = function() {
			  document.getElementById('g2').style.display = 'block';
			}
			event2.onmouseout = function() {
			  document.getElementById('g2').style.display = 'none';
			}
		</script>
	</div>

	<!--Job message box-->
	<div id="jobmsg" class="msgWindow">
		<div class="msgBody">
			<span class="close">x</span>
			<br>
			<form action="../sendMessage.php" method="post">
			<div class="info">
				<div class="topics" style="width:14%; padding-top:1%;">
					<ul>
						<li>To :</li><br><br><br>
						<li>Message :</li>
					</ul>
				</div>
				<div class="ans" style="padding-left:3%; width:80%;">
					<ul>
						<li><div class="toMsg">Job Office</div></li><br><br><br>
						<input type="hidden" name="to" value="JO">
						<input type="hidden" name="from" value="<?php echo $seccode;?>">
						<input type="hidden" name="jn" value="<?php echo $jobNo;?>">
						<input type="hidden" name="type" value="normal">
						<textarea style="cursor:auto; resize:none;" name="msg" cols="50" rows="5" placeholder="Type your message here"></textarea>
					</ul><br>
				</div>
			</div>
			<button id="submit" type="submit" name="submit" value="Register">Send</button>
			</form>
		</div>
	</div>
	<!--Job message box-->

	<!--Script to visible msg box-->
	<script>
		var msgBox = document.getElementById('jobmsg');
		var btn1 = document.getElementById("b1");
		var btn2 = document.getElementById("submit");
		var span = document.getElementsByClassName("close")[0];

		btn1.onclick = function() {
			msgBox.style.display = "block";
		}
		btn2.onclick = function() {
			msgBox.style.display = "none";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			msgBox.style.display = "none";
		}
	</script>

</body>

</html>