<?php
	session_start();
	$sec_code = $_SESSION["section"];
	if (!isset($_GET['id'])){
    	$num = 0;
	}
	else{
		$num = $_GET['id'];
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
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">
</head>

<body class="body">
	<?php include 'SHeader.php'; ?>
	<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
		
        <form>
        <input type="button" class="button" value="View Profile" onclick="openWin()">
        <input type="button" class="button" value="Add Materials" onclick="openWinM()">
        </form>
    
        <script>
        function openWin() {
            window.open("changeProf.php",'_self',false);
        }
        function openWinM() {
            window.open("AddMaterial.php",'_self',false);
        }
        </script>        
	</div>
</body>
</html>


