<?php
	session_start();
	date_default_timezone_set("Asia/Colombo");
		include 'config.php';
		$to = $_POST['to'];
		$from = $_POST['from'];
		$msg = $_POST['msg'];
		$type = $_POST['type'];
		$jn = $_POST['jn'];

		$mDate = date("Y-m-d");
		$tm = date('H:i:s', time());

		echo $to." " ;
		echo $from." " ;
		echo $msg." " ;
		echo $type." " ;
		echo $mDate." " ;
		echo $tm;

		$sqlm = "INSERT INTO messages (fr,t,type,content,mDate,mTime) VALUES ('$from','$to','$type','$msg','$mDate','$tm')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		if($qry){
			if(($_SESSION["section"]=="JO")&&($jn="JO")){
				header("Location:jobOffice/myProfile.php");
			}
			else if($_SESSION["section"]=="JO"){
				header("Location:jobOffice/JOviewjob.php?id=$jn");
			}
			else if($_SESSION["section"]=="ACC"){
				header("Location:account/viewjob.php?id=$jn");
			}
			else if($_SESSION["section"]=="admin"){
				header("Location:admin/viewjob.php?id=$jn");
			}
			else{
				header("Location:section/MRJOviewjob.php?id=$jn");
			}
		}
		else{echo "wrong";}
	
?>