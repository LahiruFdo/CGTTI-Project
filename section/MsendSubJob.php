<?php
        session_start();
        include_once '../config.php';
	    $jNo = $_POST['jno'];
		$to = $_POST['to'];
		$from = $_POST['from'];
		$subJobDetails = $_POST['subJobDetails'];
        $sjNum=$jNo."/".$to;
        $rDate = date("Y-m-d");
		
        //echo $jNo."<br>".$to."<br>".$from."<br>".$subJobDetails."<br>".$sjNum;
        $sqlsj = mysqli_query($conn,"SELECT subJob_no FROM subjob WHERE t = '$to' AND fr='$from';");
		$sj = mysqli_num_rows($sqlsj)+1;

		if($sj<10){
			$sj = "00".$sj;
		}
		else if($sj<100){
			$sj = "0".$sj;
		}
        
        $sjNum = $sjNum."/".$sj;
        //echo $sjNum;
		$sqlm = "INSERT INTO subjob (subjob_no,job_no,sj_details,fr,t,start_date,rDate) VALUES ('$sjNum','$jNo','$subJobDetails','$from','$to',NULL,'$rDate')";
		$qry = mysqli_query($conn,$sqlm);
		//header('location:$loc');

		$msg = "You have a new Sub-Job : ".$sjNum;


		$sqlm = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('$from','$to','notification','$msg','$rDate')";
		$qry1 = mysqli_query($conn,$sqlm);

		echo $jNo;
		echo $to;
		echo $from;
		echo $subJobDetails;
		echo $sjNum;

		if($qry && $qry1){
            header("Location:MOJOviewjob.php?id=$jNo");
        }
		else{echo "Sorry! error occured";} 
	
?>