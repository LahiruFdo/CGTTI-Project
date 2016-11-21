<?php
	session_start();
	$sec_code = $_SESSION["section"];
    $uname=$_SESSION['user_u'];
	if (!isset($_GET['id'])){
    	$num = 0;
	}
	else{
		

		$sql1 = mysqli_query($conn,"SELECT * FROM officer WHERE officer.section = '$sec_code' and officer.uname='$uname' ");
		$row1 = mysqli_fetch_array($sql1, MYSQL_ASSOC);
		$position = get_jt($row1['position']);
		$name= $row1['name'];
        
		

		$sql2 = mysqli_query($conn,"SELECT name FROM section WHERE code = '$code'");
		$row2 = mysqli_fetch_array($sql2, MYSQL_ASSOC);
		$sec = $row2['name']; 
		$rDate = $row1['rDate'];
		$det = $row1['details'];

        
	}

?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/view.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Section/formArea.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
    
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		
        <div class="form-area" style="background-color:#fff; height:auto;width:43.5%;margin-top:0%;">
			<div class="topBar" style="background-color:rgb(254,217,139);">Change Profile</div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1">Officer Name</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $uname; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Section</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $sec; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Section Code</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $sec_code; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">User Name</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><?php echo $uname; ?></div></dd>
			</div><br>
			<div class="list">
				<!--<dt><div class="form-fields1">Password</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1">
				<?php/* echo "<ul>";
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
                    
                    
					echo "</ul>";*/
				?>
                <br>-->  
                <dd>
                <div id = "b1" class="bt1" style="width: 45%; margin-left:42%; color:#fff; cursor:pointer">Change Password</div>                  
                </dd>	
			</div><br>       			
			</dl>
		</div>
        
        
	</div>
    
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

