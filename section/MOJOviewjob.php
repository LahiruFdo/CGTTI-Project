<?php
	session_start();
	if(isset($_SESSION["section"])){
		$secCode = $_SESSION["section"];
	}
	else{
	 header("Location:index.php");
	}

	include_once '../config.php';

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
		$vno = $row1['v_no'];
		$c = $row1['c_nic'];

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name']; 
		$rDate = $row1['rDate'];
		$det = $row1['details'];

		$sql3 = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE job_no = '$jobNo'");
		$sj = mysqli_num_rows($sql3);

		$sql4 = mysqli_query($conn,"SELECT * FROM vehicle WHERE v_no = '$vno'");
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
    
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        </style>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<link rel="stylesheet" type="text/css" href="../CSS/message.css">
	<link rel="stylesheet" type="text/css" href="../CSS/popup.css">
	<link rel="stylesheet" type="text/css" href="../CSS/section.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Section/formArea.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea">
		<div class="titleArea">
			<div class="theme"><h1>Job No. :- <span class="Number"><?php echo $jobNo; ?></span></h1></div>

		</div>
		<div class="form-area" style="background-color:#fff; height:auto;width:43.5%;margin-top:0%;">
			<div class="topBar" >Job Details</div>
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
				<?php echo "<ul>";
						if($sj == 0){
							echo "<li> --- </li>";
						}
						else{
						while($sj>0){
						$row3 = mysqli_fetch_array($sql3, MYSQL_ASSOC);
						$sjNo = $row3['subJob_no'];
						echo "<li><a href='viewSubjob.php?id=$sjNo'><b>".$row3['subJob_no']."</b></a></li>";
                            $sj-=1;
						}}
                    
                    
					echo "</ul>";
				?>
                <br>                    
                <div id = "b1" class="bt1" style="width: 45%; margin-left:0%; color:#fff; cursor:pointer">+ Add Sub-Job</div>                  
                </dd>	
			</div><br>       			
			</dl>
		</div>

		<div class="form-area" style="background-color:#fff; height:auto; width:50%;margin-top:0%; padding-bottom:2%;">
			<div class="topBar">Update Job Details</div>
			<dl>
			<form name="jobDet" action="MupdateJob.php" method="post">
				<input type="hidden" name="jno" value="<?php echo $jobNo;?>"/>
				<input type="hidden" name="oldManHr" value="<?php echo $row7['man_hrs'];?>"/>
				<input type="hidden" name="oldMachHr" value="<?php echo $row7['mach_hrs'];?>"/>
				<input type="hidden" name="extra" value="<?php echo $row7['extra'];?>"/>
                <div class="list">
					<dt><div class="form-fields1" style="width:30%;">Man Hours</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo $row7['man_hrs']." hours  + "; ?><input class="worker1" style="width:30%; float:right; margin-right:45%;" type="text" id="manHour" name="manHour" placeholder="Done Hours"/>
					</div></dd>
				</div><br>
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Machine Hours</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo $row7['mach_hrs']." hours  + "; ?><input class="worker1" style="width:30%; float:right; margin-right:45%;" type="text" id="machHour" name="machHour"  placeholder="Done Hours"  />
					</div></dd>
				</div><br> 
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Extras</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<?php echo " Rs. ".$row7['extra']." +"; ?><input class="worker1 plcFont" style="width:30%; float:none; margin-left:3%;" type="text" id="nEx" name="nEx" placeholder="Price"  />
                        <?php
                            //connect to mysql database
                            $connection = mysqli_connect("localhost","root","","cgtti") or                             die("Error " . mysqli_error($connection));
                            //fetch data from database
                            $sqlforDes = "select Description from job_extra";
                            $resultDes = mysqli_query($connection, $sqlforDes) or die("Error " . 
                            mysqli_error($connection));
                        ?>
                        <datalist id="des">
                        <?php while($row = mysqli_fetch_array($resultDes)) { ?>
                        <option value="<?php echo $row['Description']; ?>"></option>
                        <?php } ?>
                        </datalist>
                        <input class="worker1" style="width:55%; float:none; margin-left:0%; margin-top:3%;" type="text" id="nEx" name="nEx" placeholder="Description"  list="des"/>
					</div></dd>
				</div><br> 
				<div class="list">
					<dt><div class="form-fields1" style="width:30%;">Used Materials</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:65%;">
						<input class="worker2" list="material" name='wID1' autocomplete="off" placeholder="Name" style="width:50%; margin-left:0;">
                        <!--Generate Material Data From Database to List-->
                        <?php
                            //connect to mysql database
                            $connection = mysqli_connect("localhost","root","","cgtti") or                             die("Error " . mysqli_error($connection));
                            //fetch data from database
                            $sqlformate = "select name,code from materialdetails";
                            $resultmat = mysqli_query($connection, $sqlformate) or die("Error " . 
                            mysqli_error($connection));
                        ?>
                        <datalist id="material">
						    <?php while($row = mysqli_fetch_array($resultmat)) { ?>
						        <option value="<?php echo $row['name']; ?>"><?php echo $row['code']; ?></option>
						    <?php } ?>
						</datalist>
                        <datalist id="num">
                            <option value=1></option>
                            <option value=2></option>
                            <option value=3></option>
                            <option value=4></option>
                            <option value=5></option>
                            
                        </datalist>
                      
						<input class="worker1" list="num" name='name1' placeholder="Quantity" style="width:25%;">
						
						<input class="worker2" list="material" name='wID2' autocomplete="off" placeholder="Name" style="width:50%; margin-left:0; ">
						<input class="worker1" list="num" name='name2' placeholder="Quantity" style="width:25%;">
						
						<input class="worker2" list="material" name='wID3' autocomplete="off" placeholder="Name" style="width:50%; margin-left:0;">
						<input class="worker1" list="num" name='name3' placeholder="Quantity" style="width:25%;">
						
					</div></dd>
				</div><br>
				<input id="fStatus" type="hidden" name="finish" value=""/>    
				<a id = "b1" onclick="submitF()" class="bt1" style="width: 15%; margin-left:60%; margin-top: 2%;  color:#fff; cursor:pointer">Update</a> 
				<a id = "b2" href="#popup1" class="bt1" style="width: 20%; margin-left:2%; margin-top: 2%;  color:#fff; cursor:pointer">Finish Job</a>   
			</dl>
			</form>
		</div>
	</div>
                        
	
		<!--<div id = "g1" class="button-action1"><p>Send Message to</p><p>the Job Section</p></div>
		<div id = "b1" class="round-button1">fafaf</div>-->
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
		

	<!--Job message box-->
	<div id="jobmsg" class="msgWindow" style="font-size: 1.15em;">
		<div class="msgBody">
			<span class="close">x</span>
			<br>
			<form action="MsendSubJob.php" method="post">
			<input type="hidden" name="from" value="<?php echo $secCode;?>">
			<input type="hidden" name="jno" value="<?php echo $jobNo;?>">
			<div class="list">
				<dt><div class="form-fields1" style="width: 30%;">To</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs1" style="width: 65%;">
						<div id="inp" onclick="searchFunction()" class="select-button" style="width:69%; margin-top:0; border: 0.05em solid rgb(247,170,32); padding-right: 2%;">
							Click here to select a Section
						</div>
				</div></dd>
			</div>

			<div class="dropdown" style="margin-top:6%; margin-left:37%; ">
				<div id="Dropdown1" class="dropdown-content" style="overflow-y:hidden;">
						    <input type="text" placeholder="Search..." id="search1" name="to" onkeyup="filterFunction1()" value="" style="width:100%;" input required="required" >
						    <!--<option><div class="dropliast-a">WE</div><div class="dropliast-b">-</div><div class="dropliast-c">Work Engineering Section</div></option>-->
						    <option id="CH" value="CH" onclick="getValue(this)" style="background-color: #FFEFD5;">Chassis ( CH )</option>
							<option id="EN" value="EN" onclick="getValue(this)" style="background-color: #FFDAB9;">Engine ( EN )</option>
							<option id="VRS" value="VRS" onclick="getValue(this)" style="background-color: #FFEFD5;">Vehicle Repair ( VRS )</option>
							<option id="WS" value="WS" onclick="getValue(this)" style="background-color: #FFDAB9;">Welding ( WS )</option>
							<option id="AM" value="AM" onclick="getValue(this)" style="background-color: #FFEFD5;">Automobile ( AM )</option>
							<option id="AC" value="AC" onclick="getValue(this)" style="background-color: #FFDAB9;">A/C ( AC )</option>
							<option id="AE" value="AE" onclick="getValue(this)" style="background-color: #FFEFD5;">Auto Electrical ( AE )</option>
							<option id="PE" value="PE" onclick="getValue(this)" style="background-color: #FFDAB9;">Power Electrical ( PE )</option>
							<option id="MW" value="MW" onclick="getValue(this)" style="background-color: #FFEFD5;">Mill Wright ( MW )</option>
							<option id="JM" value="JM" onclick="getValue(this)" style="background-color: #FFDAB9;">Jool Machine ( JM )</option>
							<option id="BSA" value="BSA" onclick="getValue(this)" style="background-color: #FFEFD5;">Basic A ( BSA )</option>
							<option id="BSB" value="BSB" onclick="getValue(this)" style="background-color: #FFDAB9;">Basic B ( BSB )</option>
							<option id="MTTC" value="MTTC" onclick="getValue(this)" style="background-color: #FFEFD5;">MTTC ( MTTC )</option>
							<option id="IM" value="IM" onclick="getValue(this)" style="background-color: #FFDAB9;">Megatonic ( IM )</option>								
				</div>
			</div>

			<div class="list">
				<dt><div class="form-fields1">Job No.</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $jobNo;; ?></div></dd>
			</div><br>

			<div class="list">
				<dt><div class="form-fields1">Sub Job Description</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1">
					<textarea style="cursor:auto; width:90%; border: 0.05em solid rgb(247,170,32); text-align:left; font-size:1.2em; padding-left:4%; margin-left:0%; resize:none;" 
						name="subJobDetails" cols="40" rows="3" placeholder="Enter the description" input required="required">
					</textarea>
				</div></dd>
			</div><br>
			
			<button id="submit" type="submit" name="submit" value="Register" 
					style="background-color: rgb(247,170,32); width:25%; border-radius:0.5em; margin-top: 2%; margin-right: 8%;" >Send Sub Job
			</button>
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

		function searchFunction() {
			document.getElementById("Dropdown1").classList.toggle("show");
		}

		window.onclick = function(event) {
			if (!event.target.matches('.select-button')) {
				if (!event.target.matches('#search1')){
					var dropdowns = document.getElementsByClassName("dropdown-content");
					var i;
					for (i = 0; i < dropdowns.length; i++) {
						var openDropdown = dropdowns[i];
						if (openDropdown.classList.contains('show')) {
							openDropdown.classList.remove('show');
						}
					}
				}				    
			}
		}

		function filterFunction1() {
			var input, filter, ul, li, a, i;
			input = document.getElementById("search1");
			filter = input.value.toUpperCase();
			div = document.getElementById("Dropdown1");
			a = div.getElementsByTagName("option");
			for (i = 0; i < a.length; i++) {
				if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
					a[i].style.display = "";
				} else {
					a[i].style.display = "none";
				}
			}
		}

		function getValue(elem){
			var input = elem.value;
			var output = document.getElementById('inp');
			output.style.color = "black";
			var val = document.getElementById('search1');
			val.value = input;
			switch(input){
				case "WE": input="Work Engineering Section (WE)"; break;
				case "JO": input="Job Office (JO)"; break;
				case "ACC": input="Accounts Office (ACC)"; break;
				case "CH": input="Chassis (CH)"; break;
				case "EN": input="Engine (EN)"; break;
				case "VRS": input="Vehicle Repair (VRS)"; break;
				case "WS": input="Welding (WS)"; break;
				case "AM": input="Automobile (AM)"; break;
				case "AC": input="A/C Section (AC)"; break;
				case "AE": input="Auto Electrical (AE)"; break;
				case "PE": input="Power Electrical (PE)"; break;
				case "MW": input="Mill Wright (MW)"; break;
				case "JM": input="Jool Machine (JM)"; break;
				case "BSA": input="Basic A (BSA)"; break;
				case "BSB": input="Basic B (BSB)"; break;
				case "MTTC": input="MTTC"; break;
				case "IM": input="Megatonic (IM)"; break;
			}
			output.innerHTML = input;
		}

	</script>		

</body>
</html>
<?php 
