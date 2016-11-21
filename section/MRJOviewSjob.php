<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:../index.php");
	}

	include '../config.php';

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
		$gp = $row1['gatePass'];
        $jDes = $row1['details'];

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name'];
		$rDate = $row1['rDate'];
		$det = $row1['details'];

		$sql3 = mysqli_query($conn,"SELECT * FROM subjob WHERE job_no = '$jobNo'");
		$sj = mysqli_num_rows($sql3);
		$sDate = $sj['rDate'];

		$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE job_no = '$jobNo'");
		$row4 = mysqli_fetch_array($sql4, MYSQL_ASSOC);
		$vNo= $row4['v_no'];

		$sql5 = mysqli_query($conn,"SELECT * FROM customer WHERE v_no = '$vNo'");
		$row5 = mysqli_fetch_array($sql5, MYSQL_ASSOC);

		$sql6 = mysqli_query($conn,"SELECT gtpass_no FROM account WHERE job_no = '$jobNo'");
		$row6 = mysqli_fetch_array($sql5, MYSQL_ASSOC);
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
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
			<div class="theme"><h1>Sub-Job No. :- <span class="Number"><?php echo $sjobNo; ?></span></h1></div>
		</div>
		<div class="form-area" style="background-color:#fff; width:55%;margin-top:0%; padding-bottom: 2%; height: auto;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Sub-Job Details</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Job Type</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;"><?php echo $jt; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Recieved Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;"><?php echo $sDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Job Rgistered Date</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;"><?php echo $rDate; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;"><?php echo $det; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1" style="width:32%;">Worker Allocation</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1" style="width:63%;">
					<input class="worker1" name='wID1' placeholder="ID"><input class="worker2" name='name1' placeholder="Name">
					<input class="worker1" name='wID2' placeholder="ID"><input class="worker2" name='name2' placeholder="Name">
					<input class="worker1" name='wID3' placeholder="ID"><input class="worker2" name='name3' placeholder="Name">
				</div></dd>
			</div><br>
			</dl>     
		</div>

		<div class="form-area" style="background-color:#fff; height:auto; width:38%;margin-top:0%; padding-bottom: 2%;">
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
			</dl>
		</div>

		<div class="form-area" style="background-color:rgb(255,249,230); height:auto; width:40%;margin-top:3%; padding-bottom: 2%; border:0; padding-left: 5%;">
			<a href="#" class = "bt1" style="color: #fff;">View More Details</a>
			<a id="b1" href="#" class = "bt1" style="color: #fff; width:40%;">Send a message to Main-Job Section</a>
		</div>

		<form action="MstartSJob.php" method="post">
                <?php //$_SESSION["jNo"] = $sjobNo; ?>
                <input type="hidden" name="sjNo" value="<?php echo $sjobNo;?>"/>
                <div class="next-button" style="margin-left:57%; margin-top:23%;"><input type="submit" name="next" value="Start"/></div>
        </form>

		<!--
		<div id = "g1" class="button-action1"><p>Send Message to</p><p>the Job Section</p></div>
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
		</script>
		-->
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
						<li><div class="toMsg"><?php echo $sec;?></div></li><br><br><br>
						<input type="hidden" name="to" value="<?php echo $code;?>">
						<input type="hidden" name="from" value="<?php echo $secCode;?>">
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
	