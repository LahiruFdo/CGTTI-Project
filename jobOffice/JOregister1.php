<?php
	session_start();

	if(isset($_SESSION["section"])=="JO"){

		include '../config.php';
		$nameError=""; $nicError=""; $teleError=""; $emailError=""; $vnoError=""; $fTypeError=""; $regVno=""; $regJno="";
		$name = $nic = $tele = $email = $address = $vno = $cno = $eno = $fuelType ="";

		function test_input($data) {
		  	$data = trim($data);
		  	$data = stripslashes($data);
		  	$data = htmlspecialchars($data);
		  	return $data;
		}

		function checkNIC($n) {
			$numbers = substr($n, 0, -1);
			$charcter = substr($n,-1);
			$result = false;
			if(strlen($n)!=10){
				$result = true;
			}
			if(!is_numeric($numbers)){
				$result = true;
			}
			if($charcter!='V'){
				if($charcter!='v'){
					if($charcter!='X'){
						if($charcter!='x'){
							$result = true;
						}
					}
				}
			}
			return $result;
		}

		function checkTele($tele){
			$result = false;
			if(!is_numeric($tele)){
				$result = true;
			}
			/*$fNum = substr($tele, 0);
			if($fNum != 0){
				$result = true;
			}*/
			if(strlen($tele)!=10){
				$result = true;
			}
			return $result;
		}

		if($_POST && isset($_POST['name'], $_POST['nic'], $_POST['tele'], $_POST['email'], $_POST['adrs'],$_POST['vno'], $_POST['eno'], $_POST['cno'], $_POST['fuelType'])){
			$error=0;
			$name = test_input($_POST['name']);
			$nic = test_input($_POST['nic']);
			$tele = test_input($_POST['tele']);
    		$email = test_input($_POST['email']);
    		$address = test_input($_POST['adrs']);
    		$vno = test_input($_POST['vno']);
    		$cno = test_input($_POST['cno']);
    		$eno = test_input($_POST['eno']);
    		$fuelType = test_input($_POST['fuelType']);

    		if (!preg_match("/^[a-z0-9 .]+$/i",$name)) {
    			$error=1;
      			$nameError = "* Only letters and white spaces are allowed"; 
    		}
    		if ($email != ""){
	    		if (!preg_match("/^\S+@\S+$/", $email)){
	    			$error=1;
	    			$emailError = "* Invalid Email !";
	    		}
    		}
    		if ($email != ""){
    			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    			$error=1;
	      			$emailError = "* Invalid email format !"; 
    			}
    		}
    		
    		if (checkNIC($nic) == true){
    			$error=1;
    			$nicError = "* Invalid NIC number !";
    		}
    		if (checkTele($tele) == true){
    			$error=1;
    			$teleError = "* Invalid phone number format !";
    		}
    		if ($fuelType == ""){
    			$error=1;
    			$fTypeError = "* Please select a fuel type";
    		}
    		if (!preg_match("/^[a-z0-9 .\-]+$/i",$vno)) {
    			$error=1;
      			$vnoError = "* Invalid Vehicle Number !"; 
    		}

    		if($error==0){
    			//header('Location:JOregister2.php');
    			$sql = "SELECT * FROM vehicle, jobservce, customer WHERE (vehicle.v_no = jobservce.v_no AND jobservce.c_nic = customer.NIC AND vehicle.v_no = '$vno') LIMIT 1";
    			$con2 = new DatabaseCon($conn);
				$result = $con2->getConnection($sql);
				$count = $con2->getRowCount($result);

					$_SESSION['name'] = $name;
					$_SESSION['nic'] = $nic;
					$_SESSION['tele'] = $tele;
					$_SESSION['email'] = $email;
					$_SESSION['adrs'] = $address;
					$_SESSION['vno'] = $vno;
					$_SESSION['eno'] = $eno;
					$_SESSION['cno'] = $cno;
					$_SESSION['fueltyp'] = $fuelType;

				if($count == 0){
					header('Location:JOregister2.php');
					exit();
				}
				else{
					$row= $con2->getoutput($result);
					$regVno = $row['v_no'];
					$regJno = $row['job_no'];
					$regCustomer = $row['name'];
					$regRDate = $row['rDate'];
				}
    		}

		}

	}
	else{header("Location:index.php");}
?>

<!DOCTYPE html>

<html>
<head>

	<title>CGTTI JobInfo</title> 
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
	<!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
	<link rel="stylesheet" type="text/css" href="../CSS/viewJob.css">
	<link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
	<link rel="stylesheet" type="text/css" href="../CSS/popup.css">
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
	<script>
		
	</script>
 
</head>

<body class="body">
	<?php include 'JOHeader.php'; ?>
	<div class="pageArea">
	<!-- registration form-customer details-->
	<form method="post" name="register1" autocomplete="false" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="form-area">
			<div class="topBar">Customer Registration</div>
			<dl>
			
			<div class="list">
				<dt><div class="form-fields"><span style="color: red;">*</span>NIC No.</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" id="checkUser" style="padding-bottom: 0%;"><input style="width:50%;" type="text" maxlength="10" id="nic" name="nic" input required="required" value="" autocomplete="off" onkeyup="showHint(this.value)"/></div>
				<!--<input type='button' id='check_username_availability' value='Check Availability'>-->
				<?php 
				 	echo "<div class='error' id='nicCheck'>".$nicError."</div>";
				?>
			
				</dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields"><span style="color: red;">*</span>Name</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="padding-bottom: 0%;"><input type="text" id="name" name="name" input required="required" autocomplete="off"/></div><br>
				<div class="error"><?php echo $nameError; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields"><span style="color: red;">*</span></span>Contact No.</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="padding-bottom: 0%;"><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required" value="" autocomplete="off"/></div>
				<div class="error"><?php echo $teleError; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields">Email</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="padding-bottom: 0%;"><input type="text" type="email" id="email" name="email" placeholder="  example@123.com" value="" 
				autocomplete="off"/></div><br>
				<div class="error"><?php echo $emailError; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields">Address </div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs"><textarea type="text" id="adrs" name="adrs" cols="50" rows="4" value=""></textarea></div></dd>
			</div><br>
			</dl>
		</div>
		<div class="form-area" style="width: 30%;">
			<div class="topBar">Vehicle Registration</div>
			<dl><br>
			<div class="list" style="margin-top:2%;">
				<dt><div class="form-fields" style="width: 35%;"><span style="color: red;">*</span>Vehicle No.</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="width: 55%;"><input type="text" maxlength="10" id="vno" name="vno" input required="required" autocomplete="off" /></div>
				<br><div class="error" style="margin-left:27%;"><?php echo $vnoError; ?></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="width: 35%;">Engine No.</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="width: 55%;"><input type="text" maxlength="10" id="eno" name="eno" autocomplete="off"/></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields" style="width: 35%;">Chassis No.</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="width: 55%;"><input type="text" maxlength="10" id="cno" name="cno" autocomplete="off"/></div></dd>
			</div><br>
				<dt><div class="form-fields" style="width: 35%;">Fuel Type</div><div class="form-dots">:</div></dt>
				<dd><div class="form-inputs" style="width: 55%;">
					<input style="margin-top:4%;" name="fuelType" id="Diesel" type="radio" value="Diesel" input required="required"/>Diesel<br><br>
    				<input name="fuelType" id="Petrol" type="radio" value="Petrol" input required="required"/>Petrol<br><br>
    				<input name="fuelType" id="Gas" type="radio" value="Gas" input required="required"/>Gas<br>
    				<div class="error" style="margin-left:-10%;"><?php echo $fTypeError; ?></div><br><br><br><br><br>
				</div></dd>
			</div>
			</dl>
		</div>
		<script type='text/javascript'>
     		document.getElementById('name').value = '<?php echo $name; ?>';
     		document.getElementById('nic').value = '<?php echo $nic; ?>';
     		document.getElementById('tele').value = '<?php echo $tele; ?>';
     		document.getElementById('email').value = '<?php echo $email; ?>';
     		document.getElementById('adrs').value = '<?php echo $address; ?>';
     		document.getElementById('vno').value = '<?php echo $vno; ?>';
     		document.getElementById('cno').value = '<?php echo $cno; ?>';
     		document.getElementById('eno').value = '<?php echo $eno; ?>';
     	</script>
     	<script>
			function showHint(str) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					    var contact = JSON.parse(this.responseText);
					    document.getElementById('name').value = contact[0];
					    document.getElementById('tele').value = contact[1];
					    document.getElementById('email').value = contact[2];
					    document.getElementById('adrs').value = contact[3];
					}
				};
				xmlhttp.open("GET", "check_customer.php?q=" + str, true);
				xmlhttp.send();
			}
		</script>
     	<?php
     		if($regVno!=""){
     			echo '
     				<div id="warn" class="warning">
     					<h2>Notice !</h2><br>
						<h4>This vehicle was registered earlier !</h4>		
						<a class="button" style="margin-left: 30%; width:40%;" href="#popup1">View</a>
						<a class="button" style="margin-left: 30%; width:40%;" href="JOregister2.php">Ignore</a>
     				</div>';
     		}
     	?>
		<div class="next-button"><input type="submit" name="next" value="Next >>>"/></div>		
	</form>
	<!-- end of registration form -->
	</div>
	
	<div id="popup1" class="overlay">
		<div class="popup">
			<a class="close" href="#">&times;</a>
			<br>
			<h4>This vehicle was registered earlier !</h4>
			<br>			
			<div class="content" style="text-align:center;">
				<div class="list">
					<dt><div class="form-fields1" style="width:45%;">Vehicle no</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:45%; padding-left: 1%;"> <?php echo $regVno; ?></div></dd>
				</div><br>
				<div class="list">
					<dt><div class="form-fields1" style="width:45%;">Job No</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:45%; padding-left: 1%;"> <?php echo $regJno; ?></div></dd>
				</div><br>
				<div class="list">
					<dt><div class="form-fields1" style="width:45%;">Registered Date</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:45%; padding-left: 1%;"> <?php echo $regRDate; ?></div></dd>
				</div><br>
				<div class="list">
					<dt><div class="form-fields1" style="width:45%;">Customer Name</div><div class="form-dots2">:</div></dt>
					<dd><div class="form-inputs1" style="width:45%; padding-left: 1%;"> <?php echo $regCustomer; ?></div></dd>
				</div><br>
			</div>
			<a class="button" style="margin-left: 33%; width: 34%;" onclick="open_win()">View More</a>
		</div>
	</div>
	<script type="text/javascript">
		function warnMessage(){
			document.getElementById('warn').style.display = "block";
		}
		function open_win(){
			window.open("JOviewjob.php?id=<?php echo $regJno; ?>", "_blank");
		}
	</script>
</body>

</html>