<?php
	session_start();

	if(isset($_SESSION["section"])=="JO"){  
		include '../config.php';
	}
	else{
	 	header("Location:../index.php");
	}

	$error = "";

	if(isset($_GET['error'])){
		if($_GET['error'] == 1){
			$error = "*** Password is incorrect";
		}
		else if($_GET['error'] == 2){
			$error = "*** New Password does not match";
		}
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/button.css">
	<link rel="stylesheet" type="text/css" href="../CSS/details.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../CSS/jo-home.css">
	<link rel="stylesheet" type="text/css" href="../CSS/profile.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	
 	<style>
 		.btn-name{
 			margin-left:5%;
 		}
 	</style>
</head>

<body class="body">

	<?php include 'JOHeader.php'; ?>

	<div class="page" style="margin-left: 22%; width:78%;">
		<div class="page-area-1" style="margin-top: 2%;">
			<h1><i class="fa fa-user fa-lg"></i><span style="margin-left: 2%;">My Profile</span></h1>
		</div>
		
		<div class="page-area-1" style="margin-top: 3%;">
			<div class="profCard">
				<div class="nameCard">Name</div>
				<div class="answerCard">W.L.D. Fernando</div>
				<div class="nameCard">Section</div>
				<div class="answerCard">Job Office</div>
				<div class="nameCard">Position</div>
				<div class="answerCard">Job Officer</div>
			</div>
			<div class="profImage">
				<img src="../images/u-pic.png" style="width: 150px; height: 170px;"/>
				<div class="pic-update"><i class="fa fa-camera"></i> Update Picture</div>
			</div>
		</div>

		<div class="page-area-1" style="margin-top: 2%;">
			<a href="#" id="b1">
				<div class="profile-button" style="margin-left: 0%;"><i class="fa fa-commenting"></i><span class="btn-name">Add Comments</span></div>
			</a>
			<a href="#" id="b2">
				<div class="profile-button"><i class="fa fa-envelope"></i><span class="btn-name">Message to admin</span></div>
			</a>
			<a href="#" id="b3">
				<div class="profile-button"><i class="fa fa-lock"></i><span class="btn-name">Change Password</span></div>
			</a>
		</div>
		
		<div class="page-area-1" id="comment" style="margin-top: 2%;">
			<form action='../comment.php?id=t' method="post">
				<div class="info">
						<div class="topics" style="width:14%; padding-top:1%;">
							<ul>
								<li>Comment :</li>
							</ul>
						</div>
						<div class="ans" style="padding-left:3%; width:60%;">
							<ul>
								<input type="hidden" name="from" value="<?php echo "JO";?>">
								<textarea style="cursor:auto; resize:none; border-color: rgb(247,170,32);" name="msg" cols="50" rows="3" placeholder="Type your comment here" input required='required' ></textarea>
							</ul><br>
						</div>
				</div>
				<button class="send-button" type="submit">ADD</button> 
			</form>
		</div>

		<div class="page-area-1" id="message" style="margin-top: 2%;">
			<form action="../sendMessage.php" method="post">
				<div class="info">
						<div class="topics" style="width:14%; padding-top:1%;">
							<ul>
								<li>Message :</li>
							</ul>
						</div>
						<div class="ans" style="padding-left:3%; width:60%;">
							<ul>
								<input type="hidden" name="to" value="<?php echo "WE"?>">
								<input type="hidden" name="from" value="<?php echo "JO";?>">
								<input type="hidden" name="jn" value="<?php echo "JO";?>">
								<input type="hidden" name="type" value="normal">
								<textarea style="cursor:auto; resize:none; border-color: rgb(247,170,32);" name="msg" cols="50" rows="3" placeholder="Type your message here" input required='required' ></textarea>
							</ul><br>
						</div>
				</div>
				<button class="send-button" type="submit">SEND</button> 
			</form>
		</div>

		<div class="page-area-1" id="pw1" style="margin-top: 2%;">
			<form action="../changePW.php" method="post">
				<div class="pw-change">
					<div class="inputName">Current Password</div>
					<input type="password" name="password1" placeholder="Enter current password"/>
					<div class="inputName">New Password</div>
					<input type="password" name="password1" placeholder="Enter new password"/>
					<div class="inputName">Confirm Password</div>
					<input type="password" name="password2" placeholder="Re-Enter new password"/>
					<button class="update-button" type="submit">Change</button> 
				</div>
				<div class="warning-area" style="float:left; margin-top: 5%; margin-left: 5%; color:red;">
				</div>
			</form>
		</div>

	</div>

	<script>
		var comment = document.getElementById('comment');
		var message = document.getElementById('message');
		var pw1 = document.getElementById('pw1');
		var bt1 = document.getElementById('b1');
		var bt2 = document.getElementById('b2');
		var bt3 = document.getElementById('b3');

		bt1.onclick = function() {
			//pw2.style.display = "none";
			pw1.style.display = "none";
			message.style.display = "none";
			comment.style.display = "block";
		}

		bt2.onclick = function() {
			//pw2.style.display = "none";
			pw1.style.display = "none";
			comment.style.display = "none";
			message.style.display = "block";
		}

		bt3.onclick = function() {
			//pw2.style.display = "none";
			message.style.display = "none";
			comment.style.display = "none";
			pw1.style.display = "block";
		}
	</script>

</body>

</html>