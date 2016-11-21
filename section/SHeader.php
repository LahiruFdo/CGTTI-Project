<?php
	$secCode=$_SESSION['section'];
	$user=$_SESSION['user'];

	include_once "../config.php";
	//get the section name
        $sql = "SELECT section.name FROM section WHERE section.code='$secCode'";
        $qry = mysqli_query($conn,$sql);
        $sec = $qry->fetch_assoc();
        $sec = $sec['name'];
?>

<header>
	<style type="text/css">
		.aname{
			margin-left: 5%;
		}
		.dropbar{
			background-color: #000;
			margin-bottom: 1%;
			height: 100%;
			margin-top: -27%;
			position: relative; 
		}
	</style>
	<div class="header">
		<div class="header1">
			<div class="logo">CGTTI - <span style="font-size: 0.65em;"> Job Information System</span>
			</div>
			<div class="loginAs"><?php echo $user." ";?><i class="fa fa-caret-down fa-lg" onclick="dropDownFunction()" style="cursor: pointer;"></i></div>
		</div>

		<div class="header2">
		</div>

		<div id="dd" style="float:right; z-index: 999;margin-right: 3%; width: 10%; display: none;">
			<div class="dropbar">
				<ul id="nav">
					<li><a href="#">My Profile</a></li>
					<li><a href="#">Messages</a></li>
					<li><a href="../logout.php">Log Out</a></li>
				</ul>
			</div>						
		</div>
	</div>

	

	<div class="sidebar">
		<center><img src="../images/user1.png" /></center>
		<center style="font-size: 1.2em; color: white;"><strong><?php echo $sec." Section"; ?></strong></center>
		<br>
		<!--<div class="profile-image"><img src="images/user1.png" /></div>-->
		<ul id="nav">
			<li><a  style="font-size: 1.3em;border-top: 0.05em solid #403D3E;" href="section.php"><i class="fa fa-home"></i><span class="aname">My Home</span></a></li>
			<li><a  href="viewAll.php"><i class="fa fa-cogs"></i><span class="aname">View All Jobs</span></a></li>	
			<li><a  href="rSubjob.php"><i class="fa fa-mail-reply"></i><span class="aname">Received SubJobs</span></a></li>	
			<li><a  href="sSubjob.php"><i class="fa fa-mail-forward"></i><span class="aname">Sent Subjobs</span></a></li>
			<li><a  href="finishedJobs.php"><i class="fa fa-list-alt"></i><span class="aname">View Finished Jobs</span></a></li>
		</ul>
	</div>

	<script type="text/javascript">
		function dropDownFunction() {
			var x = document.getElementById("dd");
			if(x.style.display == "block"){
				x.style.display = "none";
			}
			else{
				x.style.display = "block";
			}
		}
		function dropDown1Function() {
			var x = document.getElementById("dd");
			if(x.style.display == "block"){
				x.style.display = "none";
			}
			else{
				x.style.display = "block";
			}
		}

		$(document).click(function() {
		    $('#dd').hide();
		 })//doesn't work

	</script>
</header>