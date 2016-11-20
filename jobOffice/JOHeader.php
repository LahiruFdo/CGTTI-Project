<?php
	$secCode=$_SESSION['section'];
	$user=$_SESSION['user'];
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
		<div class="profileImage"><img src="../images/user1.png" /></div>
		<div class="logo" style="margin-left: 31.5%; font-size: 1.2em;">Job Office</div>
		<br>
		<!--<div class="profile-image"><img src="images/user1.png" /></div>-->
		<ul id="nav">
			<li><a  style="font-size: 1.3em;border-top: 0.05em solid #403D3E;" href="jobOffice.php"><i class="fa fa-home"></i><span class="aname">My Home</span></a></li>
			<li><a  href="JOregister1.php"><i class="fa fa-plus"></i><span class="aname">Add New Job</span></a></li>	
			<li><a  href="JOview.php?id=0"><i class="fa fa-cogs"></i><span class="aname">View All Jobs</span></a></li>	
			<li><a  href="JOnewClosedJ.php?id=0"><i class="fa fa-cog"></i><span class="aname">Completed Jobs</span></a></li>
			<li><a  href="JOvehicle.php?id=0"><i class="fa fa-list"></i><span class="aname">View Vehicle Details</span></a></li>
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