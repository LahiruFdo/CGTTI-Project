<?php
include '../config.php';
	session_start();
	
		$jobdes = $_POST['jobdes'];
		$jTyp = $_POST['jobType'];
		$sCode = $_POST['secCode'];
		$tDate = $_POST['date'];

		$name = $_SESSION['name'];
		$nic = $_SESSION['nic'];
		$tele = $_SESSION['tele'];
		$email = $_SESSION['email'];
		$adrs = $_SESSION['adrs'];

		$vno = $_SESSION['vno'];
		$eno = $_SESSION['eno'];
		$cno = $_SESSION['cno'];
		$fueltyp = $_SESSION['fueltyp'];

		$rDate = date("Y-m-d");

		$jno = "GT/16/".$jTyp."/".$sCode."/".$_SESSION['index'];

		echo $jobdes." ";
		echo $jTyp." ";
		echo $sCode." ";
		echo $tDate." ";
		echo $name." ";
		echo $nic." ";
		echo $tele." ";
		echo $email." ";
		echo $adrs." ";
		echo $vno." ";
		echo $eno." ";
		echo $cno." ";
		echo $fueltyp." ";
		echo $jno." ";

	$cs1 = "SELECT * FROM customer WHERE ( NIC = '$nic' )";
	$qr1 = mysqli_query($conn,$cs1);

	$cs2 = "SELECT * FROM vehicle WHERE ( v_no = '$vno' )";
	$qr2 = mysqli_query($conn,$cs2);

	$sql1 = "INSERT INTO customer (NIC,name,contact_no,address,email) VALUES ('$nic','$name','$tele','$adrs','$email')";
	$sql2 = "INSERT INTO vehicle (v_no,c_NIC,eng_no,che_no,fuel_typ) VALUES ('$vno','$nic','$eno','$cno','$fueltyp')";
	$sql3 = "INSERT INTO jobservce (job_no,v_no,c_nic,job_typ,details,sec_code,rDate,tDate) VALUES ('$jno','$vno','$nic','$jTyp','$jobdes','$sCode','$rDate','$tDate')";
	$sql4 = "INSERT INTO job (job_no, start_date) VALUES ('$jno', NULL)";
	$msg = "You have a new Job : ".$jno;
	$sqlm = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('JO','$sCode','notification','$msg','$rDate')";

	if((mysqli_num_rows($qr1)>0)&&(mysqli_num_rows($qr2)>0)){
		echo "1";
		$qry3 = mysqli_query($conn,$sql3);
		$qry4 = mysqli_query($conn,$sql4);
		$qry = mysqli_query($conn,$sqlm);
		// if($qry3 && $qry4 && $qry){
			header('Location:jobOffice.php');
		// }
	}

	else if(mysqli_num_rows($qr1)>0){
		echo "2";
		$qry2 = mysqli_query($conn,$sql2);	
		$qry3 = mysqli_query($conn,$sql3);
		$qry4 = mysqli_query($conn,$sql4);
		$qry = mysqli_query($conn,$sqlm);
		// if($qry2 && $qry3 && $qry4 && $qry){
			header('Location:jobOffice.php');
		// }
	}
	// $pwData = mysqli_fetch_array($squery1, MYSQLI_ASSOC);

	else if(mysqli_num_rows($qr2)>0){
		echo"3";
		$qry1 = mysqli_query($conn,$sql1);	
		$qry3 = mysqli_query($conn,$sql3);
		$qry4 = mysqli_query($conn,$sql4);
		$qry = mysqli_query($conn,$sqlm);
		// if($qry1 && $qry3 && $qry4 && $qry){
			header('Location:jobOffice.php');
		// }
	}

	else{
		echo "5";
		$qry1 = mysqli_query($conn,$sql1);
		$qry2 = mysqli_query($conn,$sql2);
		$qry3 = mysqli_query($conn,$sql3);
		$qry4 = mysqli_query($conn,$sql4);
		$qry = mysqli_query($conn,$sqlm);
		// if($qry1 && $qry2 && $qry3 && $qry4 && $qry){
			header('Location:jobOffice.php');
		// }
	}

?>