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
			<div class="topBar" style="background-color:rgb(254,217,139);">Material </div>
			<dl>
			<div class="list">
				<dt><div class="form-fields1">Code</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required" value="" autocomplete="off" placeholder="  Material Code "/></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Name</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required" value="" autocomplete="off" placeholder="  Material Name "/></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Price</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required" value="" autocomplete="off" placeholder="  Price "/></div></dd>
			</div><br>
			<div class="list">
				<dt><div class="form-fields1">Vehicle</div><div class="form-dots2">:</div></dt>
				<dd><div class="form-inputs1"><input style="width:50%;" type="text" maxlength="10" id="tele" name="tele" input required="required" value="" autocomplete="off" placeholder="  Vehicle "/></div></dd>
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
                <div id = "b1" class="bt1" style="width: 45%; margin-left:42%; margin-top:8%; color:#fff; cursor:pointer">+ Add Material</div>                  
                </dd>	
			</div><br>       			
			</dl>
		</div>
        
        
	</div>
</body>
</html>

