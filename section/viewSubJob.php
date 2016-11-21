<?php
	session_start();
	$seccode = $_SESSION['section'];
	include '../config.php';

	if (!isset($_GET['id'])){
    	echo 'No ID was given...';
    	exit;
	}
	else{
		$SjobNo = $_GET['id'];

		$sql1 = mysqli_query($conn,"SELECT * FROM subjob WHERE subJob_no = '$SjobNo'");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);


		$mainsec = $row1['fr'];
		$sec = $row1['t'];

		$sql2 = mysqli_query($conn,"SELECT name,code FROM section WHERE (code = '$mainsec' OR code = '$sec')");
		while($row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC)){
			if($row2['code'] == $mainsec){ $mainsec = $row2['name'];}
			else if($row2['code'] == $sec){ $sec = $row2['name']; $code = $row2['code'];}
		}
		

		$sDate = $row1['start_date'];

		if($row1['finish_date']==''){
			$fDate = '---';
		}
		else{
			$fDate = $row1['finish_date'];
		}
		
		$det = $row1['sj_details'];

		$jNo = $row1['job_no'];

		if($fDate=="---"){
			$status = "Unfinished";
		}
		else{
			$status = "Finished";
		}
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
			<div class="theme"><h1>Sub-Job No. :- <span class="Number"><?php echo $SjobNo; ?><div class="status"><?php echo "<mark>( Status : ".$status." )</mark>"; ?></div></span></h1></div>

		</div>
		<div class="form-area" style="background-color:#fff; height:auto; width:43.5%;margin-top:0%; margin-left: 15%; padding-bottom:3%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Sub-Job Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Job No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $jNo; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Sub-Job Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $det; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Sub-Job Start Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $sDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Sub-Job Finish Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $fDate; ?></div></dd>
			</div><br>
			</dl>
		</div>
		
		<div id = "g1" class="button-action1" style="margin-left:58%;margin-top:7%;"><p>Send Message to</p><p>the Sub-Job Section</p></div>
		<a href="#" style="text-decoration: none; color:black"><div id = "b1" class="round-button1" style="margin-left: 52%;">
			<img src="../images/mesg.png" style="width:60%; height:80%; margin-top:5%; margin-left:20%; ">
		</div></a>
		<a href="Sub-Job-Details(PDF).php?id=$SjobNo" target="_blank" style="text-decoration: none; color:black"><div id = "b2" class="round-button2" style="margin-left: 52%;"><img src="../images/download.png" style="width:80%; height:75%; margin-top:5%; margin-left:10%; "></div></a>
		<div id = "g2" class="button-action1" style="margin-left:58%;margin-top:13.5%;"><p>Download Details</p></div><br>
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
						<li><div class="toMsg"><?php echo $sec." Section";?></div></li><br><br><br>
						<input type="hidden" name="to" value="<?php echo $sec;?>">
						<input type="hidden" name="from" value="<?php echo "$seccode";?>">
						<input type="hidden" name="jn" value="<?php echo $SjobNo;?>">
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