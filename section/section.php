<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:../index.php");
	}
    include_once "../config.php";

    //get the message counts and message details
    $sql2 = "SELECT COUNT(*) AS 'inboxCount' FROM messages WHERE (t='$secCode' AND readBy='F')";
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_assoc($result2);
		$inboxCount = $row['inboxCount'];
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">
	<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
	<link rel="stylesheet" type="text/css" href="../CSS/details.css">
    <link rel="stylesheet" type="text/css" href="../CSS/section.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>

	<div style="position:absolute; margin-left:77%; width: 20%; float:right; margin-top:8%; padding-bottom:2%;">
		<?php include 'details.php' ?>
	</div>

	<div class="pageArea" style="width:80%;">
        <!-- home buttons -->
		<div class="contentArea">
			<a href="message.php">
			<div class="message-button">
				<div class="inner-left-corner" style="padding-left:28%;"><i class="fa fa-envelope fa-4x" style="color: #fff;"></i></div>
				<div class="button-text-1">Messages<?php if($inboxCount>0){echo "<div class='inbox-number'>".$inboxCount."</div>";}?></div>
			</div>
			</a>
			<a href="#" id="b1">
			<div class="comment-button">
				<div class="inner-left-corner" style="padding-left:28%;"><i class="fa fa-comment fa-4x" style="color: #fff;"></i></div>
				<div class="button-text-1">Add Comments</div>
			</div>
			</a>
			<div class="detail-button-area">
				<a href="#popup1">
				<div class="contact-button">
					<div class="inner-mid-corner" style="padding:4%;"><i class="fa fa-list fa-2x" style="color: #fff;"></i></div>
					<div class="button-text-2">Job Details</div>
				</div>
				</a>
				<a href="#" id="b2">
				<div class="details-button">
					<div class="inner-mid-corner" style="padding:4%;"><i class="fa fa-group fa-2x" style="color: #fff;"></i></div>
					<div class="button-text-2">Contacts</div>
				</div>
				</a>
			</div>
		</div>
		<!-- end of home buttons -->

        <div class="page-area1" style="width:70%;">
			<div class="windowBttn">
				<b>New Received Jobs</b>
			</div>
			<div class="profInfo">
				<?php
					$sql = "SELECT jobservce.job_no,jobservce.sec_code,jobservce.job_typ,jobservce.rDate,jobservce.details,job.start_date FROM jobservce RIGHT JOIN job ON jobservce.job_no=job.job_no WHERE  jobservce.sec_code='$secCode' AND job.start_date IS NULL";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th></th><th> Registered Date </th><th> Job Type</th><th> Job Description </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["job_no"];				        
						        echo "<tr><td><a href='MRJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["rDate"]. "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . get_jt($row["job_typ"]) . "</a></td><td><a href='MRJOviewjob.php?id=$a'>" . $row["details"]."</a></td></tr>";                               
                               
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No new jobs.";
					    }
					}
				?>
			</div><br><br>
		</div>
        <div class="page-area1" style="margin-top:-4%; width:70%;">
			<div class="windowBttn">
				<b>New Received Sub Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					$sql = "SELECT subjob.subjob_no,subjob.job_no,subjob.sj_details,subjob.fr,subjob.t,jobservce.job_typ FROM subjob RIGHT JOIN jobservce ON jobservce.job_no=subjob.job_no WHERE  subjob.t='$secCode' AND subjob.start_date IS NULL";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> SubJob No </th><th> Job No</th><th> Details </th><th> From </th><th> Job Type </th>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["subjob_no"];
						    	$sj_d = $row["sj_details"];
                                $frm=$row["fr"];
                                $t=$row["t"];
						        $fsection = $conn->query("SELECT name FROM section WHERE code='$frm'");
						        $fsec = $fsection->fetch_assoc();
                                $jnum = $row["job_no"];
                          		        
						        echo "<tr><td><a href='MRJOviewSjob.php?id=$a'>" . $row["subjob_no"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $row["sj_details"]. "</a></td><td><a href='MRJOviewSjob.php?id=$a'>" . $fsec["name"]. "</a></td><td><a href='MRJOviewSjobs.php?id=$a'>" . $row["job_typ"]."</a></td></tr>";
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No new sub-jobs.";
					    }
					}
				?>
			</div>
		</div>
        <div class="page-area1" style="width:70%;">
			<div class="windowBttn">
				<b>Ongoing Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					$sql = "SELECT jobservce.job_no,jobservce.sec_code,jobservce.job_typ,jobservce.tDate,jobservce.rDate,jobservce.details,job.start_date FROM jobservce RIGHT JOIN job ON jobservce.job_no=job.job_no WHERE jobservce.closedDate IS NULL AND jobservce.sec_code='$secCode' AND job.start_date IS NOT NULL AND job.finished_date IS NULL";	
              
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> Job No </th><th> Job Description </th><th> Registered Date </th><th> Started Date </th><th> Target Date </th>";
					    	while($row = mysqli_fetch_assoc($result)) {
					    		$a=$row["job_no"];
						        echo "<tr><td><a href='MOJOviewjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["details"]. "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["rDate"] . "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["start_date"] . "</a></td><td><a href='MOJOviewjob.php?id=$a'>" . $row["tDate"] . "</a></td></tr>";
					     	}
					     	echo "</table>";}
					 	else {
					     	echo "No ongoing Jobs at the moment";
					    }
					}
				?>
			</div>
			<br>
			<!--Code for Generate Ongoing Job End-->
                
                    <!--Code for Generate Ongoing Sub Job -->
	
		</div>
        <div class="page-area1"	style="margin-top:-2%; width:70%;">
			<div class="windowBttn">
				<b>Ongoing Sub Jobs</b>
			</div>
			<div class="profInfo" >
				<?php
					$sql = "SELECT subjob.subjob_no,subjob.job_no,subjob.sj_details,subjob.fr,subjob.start_date,jobservce.job_typ FROM subjob RIGHT JOIN jobservce ON jobservce.job_no=subjob.job_no WHERE  subjob.t='$secCode' AND subjob.start_date IS NOT NULL AND subjob.finish_date IS NULL";	
					
					if ($result = mysqli_query($conn,$sql)) {
						$count = mysqli_num_rows($result);
						if($count >0){
					    	echo "<table><tr><th> SubJob No </th><th> Job No</th><th> Details </th><th> From </th><th> Job Type </th><th> Started Date </th></tr>";
					     	// output data of each row
					    	while($row = mysqli_fetch_assoc($result)) {
						    	$a=$row["subjob_no"];
						    	$sj_d = $row["sj_details"];
                                $frm=$row["fr"];
						        $fsection = $conn->query("SELECT name FROM section WHERE code='$frm'");
						        $fsec = $fsection->fetch_assoc();
                                $jnum = $row["job_no"];
                          		        
						        echo "<tr><td><a href='MOJOviewSjob.php?id=$a'>" . $row["subjob_no"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $row["job_no"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $row["sj_details"]. "</a></td><td><a href='MOJOviewSjob.php?id=$a'>" . $fsec["name"]. "</a></td><td><a href='MOJOviewSjobs.php?id=$a'>" . $row["job_typ"]."</a></td><td><a href='MOJOviewSjobs.php?id=$a'>" . $row["start_date"]."</a></td></tr>";
						   	}
					     	echo "</table>";}
					 	else {
					     	echo "No ongoing sub-jobs at the moment";
					    }
					}
				?>
			</div>
		</div>
		<br>
			<!--Code for Generate Ongoing Job End-->
                
                    <!--Code for Generate Ongoing Sub Job -->
	
            <!--Comments box-->
		<div id="comments" class="msgWindow">
			<div class="msgBody">
				<span id="c1" class="close">x</span>
				<br>
				<form action='../comment.php' method="post">
				<div class="info">
					<div class="topics" style="width:14%; padding-top:1%;">
						<ul>
							<li>Comment :</li>
						</ul>
					</div>
					<div class="ans" style="padding-left:3%; width:80%;">
						<ul>
							<input type="hidden" name="from" value="<?php echo "JO";?>">
							<textarea style="cursor:auto; resize:none; border-color: rgb(247,170,32);" name="msg" cols="50" rows="5" placeholder="Type your comment here" input required='required' ></textarea>
						</ul><br>
					</div>
				</div>
				<button style="background-color:rgb(247,170,32);" id="submit" type="submit" name="submit" value="Register">Send</button>
				</form>
			</div>
		</div>
	<!--Comments box-->

	<!--details box-->
		<div id="popup1" class="overlay">
			<div class="popup">
				<a class="close" href="#">&times;</a>
				<br><br>
				<div class="content">
					Thank to pop me out of that button, but now i'm done so you can close this window.
				</div>
			</div>
		</div>	
	<!--details box-->

	<!--details box-->
		<div id="contacts" class="msgWindow">
			<div class="msgBody">
				<span id="c2" class="close"><h3>x</h3></span>
				<div class="contact-details">
				<h2>Contacts</h2>
				</div>
				<?php //include 'details.php';//?>
			</div>
		</div>
	<!--details box-->

	<!--Script to visible window boxes-->
		<script>
			var msgBox = document.getElementById('comments');
			//var detailBox = document.getElementById('details');
			var contactsBox = document.getElementById('contacts');
			var btn1 = document.getElementById("b1");
			var btn2 = document.getElementById("submit");
			var btn3 = document.getElementById("b2");
			var close1 = document.getElementById("c1");
			var close2 = document.getElementById("c2");
			/*var span = document.getElementsByClassName("close")[0];*/

			btn1.onclick = function() {
				msgBox.style.display = "block";
			}
			close1.onclick = function() {
				msgBox.style.display = "none";
			}
			btn2.onclick = function() {
				msgBox.style.display = "none";
			}
			btn3.onclick = function() {
				contactsBox.style.display = "block";
			}
			close2.onclick = function() {
				contactsBox.style.display = "none";
			}
			

			// When the user clicks on <span> (x), close the modal
			/*span.onclick = function() {
				if(msgBox.style.display == "block"){msgBox.style.display = "none";}
				else if(detailBox.style.display == "block"){detailBox.style.display.style.display = "none";}
				else{contactsBox.style.display = "none";}
			}*/
		</script>
    </div>


</body>
</html>


