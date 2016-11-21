<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:../index.php");
	}

	include_once '../config.php';


	if (!isset($_GET['id'])){
    	echo 'No ID was given...';
    	exit;
	}
	else{
		$sjobNo = $_GET['id'];
        $jobNumber = mysqli_query($conn,"SELECT job_no FROM subjob WHERE subjob_no = '$sjobNo'");
        $rowJn=mysqli_fetch_array($jobNumber, MYSQL_ASSOC);
        $jobNo=$rowJn['job_no'];
        
		$sql1 = mysqli_query($conn,"SELECT * FROM jobservce WHERE job_no = '$jobNo'");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
		$jt = get_jt($row1['job_typ']);
		$code = $row1['sec_code'];
		$cDate = $row1['closedDate'];
		$vno = $row1['v_no'];
		$c = $row1['c_nic'];

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name'];
		$rDate = $row1['rDate'];
		$det = $row1['details'];

		$sql3 = mysqli_query($conn,"SELECT * FROM subjob WHERE subjob_no = '$sjobNo'");
        $row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);
        $sjD = $row3['sj_details'];
        $sjManH = $row3['man_hrs'];
        $sjMachH = $row3['mach_hrs'];
        $sDate = $row3['rDate'];
        $dec1 = $row3['sj_details'];

		$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$vno'");
		$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
		$vNo= $row4['v_no'];

		$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE NIC = '$c'");
		$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);

		$sql6 = mysqli_query($conn,"SELECT gtpass_no FROM account WHERE job_no = '$jobNo'");
		$row6 = mysqli_fetch_array($sql6, MYSQL_ASSOC);

        $sql7 = mysqli_query($conn,"SELECT * FROM job WHERE job_no = '$jobNo'");
		$row7 = mysqli_fetch_array($sql7, MYSQL_ASSOC);
        
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<link rel="stylesheet" type="text/css" href="../CSS/message.css">
	<link rel="stylesheet" type="text/css" href="../CSS/popup.css">
	<link rel="stylesheet" type="text/css" href="../CSS/section.css">
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
			<div class="theme"><h1>Sub Job No. :- <span class="Number"><?php echo $sjobNo; ?></span></h1></div>

		</div>
		<div class="form-area" style="background-color:#fff; height:auto;width:43.5%;margin-top:0%; padding-bottom:5%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Sub Job Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Job Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $jt; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Recieved Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $sDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Job Rgistered Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $rDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Sub-Job Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $dec1; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:38%;">Job Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:55%;"><?php echo $det; ?></div></dd>
			</div><br>
			</dl>
		</div>
		<div class="form-area" style="background-color:#fff; height:auto; width:50%;margin-top:0%; padding-bottom:2%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Update Job Details</div>
			<dl>
			<form name="jobDet" action="MupdateSJob.php" method="post">
				<input type="hidden" name="jno" value="<?php echo $sjobNo;?>"/>
				<input type="hidden" name="oldManHr" value="<?php echo $row3['man_hrs'];?>"/>
				<input type="hidden" name="oldMachHr" value="<?php echo $row3['mach_hrs'];?>"/>
				<input type="hidden" name="extra" value="<?php echo $row3['extra'];?>"/>
                <div class="list">
					<dt><div class="form-fields1" style="width:30%;">Man Hours</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo $row3['man_hrs']." hours  + "; ?><input class="worker1" style="width:25%; float:right; margin-right:50%;" type="text" id="manHour" name="manHour"/>
					</div></dd>
				</div><br>
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Machine Hours</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo $row3['mach_hrs']." hours  + "; ?><input class="worker1" style="width:25%; float:right; margin-right:50%;" type="text" id="machHour" name="machHour"  />
					</div></dd>
				</div><br> 
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Extras</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo " Rs. ".$row3['extra']." +"; ?><input class="worker1" style="width:25%; float:none; margin-left:3%;" type="text" id="nEx" name="nEx"  />
					</div></dd>
				</div><br> 
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Used Materials</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<input class="worker2" name='wID1' placeholder="Name" style="width:50%; margin-left:0;">
						<input class="worker1" name='name1' placeholder="Quantity" style="width:19%;">
						<input class="worker1" name='name1' placeholder="Total Price" style="width:30%;">
						<input class="worker2" name='wID2' placeholder="Name" style="width:50%; margin-left:0;">
						<input class="worker1" name='name2' placeholder="Quantity" style="width:19%;">
						<input class="worker1" name='name2' placeholder="Total Price" style="width:30%;">
						<input class="worker2" name='wID3' placeholder="Name" style="width:50%; margin-left:0;">
						<input class="worker1" name='name3' placeholder="Quantity" style="width:19%;">
						<input class="worker1" name='name3' placeholder="Total Price" style="width:30%;">
					</div></dd>
				</div><br>
				<input id="fStatus" type="hidden" name="finish" value=""/>    
				<a id = "b1" onclick="submitF()" class="bt1" style="width: 15%; margin-left:60%; margin-top: 2%;  color:#fff; cursor:pointer">Update</a> 
				<a id = "b2" href="#popup1" class="bt1" style="width: 20%; margin-left:2%; margin-top: 2%;  color:#fff; cursor:pointer">Finish Job</a>   
			</form>
			</dl>
		</div>
	</div>

		<div id="popup1" class="overlay">
			<div class="popup" style="height:16%; padding-bottom:3%;">
				<br>			
				<div class="content" style="text-align:center; height:auto;">
					Do you want to finish the job ?
				</div>
				<a class="button" style="margin-left: 25%; width: 25%;" onclick="fin()"><b>Yes</b></a>
				<a class="button" style="margin-left: 1%; width: 25%;" href="#"><b>No</b></a>
			</div>
		</div>

		<script>
			function fin(){
				var val1 = document.getElementById('fStatus');
				val1.value = "Y";
				document.jobDet.submit();
			}
			function submitF(){
				document.jobDet.submit();
			}
		</script> 
		<!--<div id = "g1" class="button-action1"><p>Send Message to</p><p>the Job Section</p></div>
		<div id = "b1" class="round-button1">fafaf</div>
		<div id = "b2" class="round-button2">fafaf</div>
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
	</script>-->
	
</body>
</html>