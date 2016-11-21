<?php 

session_start();
    $secCode = $_SESSION['section'];
  include_once '../config.php';  
        
		$jobNo = $_POST['jno'];
        $oMH = $_POST['oldManHr'];
        $oMcnH = $_POST['oldMachHr'];
        $oEx = $_POST['extra'];
        $manHr = $_POST['manHour'];
        $machHr = $_POST['machHour'];
        $nEx = $_POST['nEx'];
        $nMH = $oMH + $manHr ;
        $nMcnH = $oMcnH + $machHr ;
        $nEx = $oEx + $nEx;
        $f = $_POST['finish'];
        /*$code = "GT";
        $Mat = $_POST['mat'];
        $qun = $_POST['quan'];
        $upr = $_POST['upr'];*/
        $materialsname=
        $sql="UPDATE job set man_hrs='$nMH' , mach_hrs='$nMcnH' , extra='$nEx' where job_no='$jobNo'";
        $rst=mysqli_query($conn,$sql);
    $sql1 = "INSERT INTO `cgtti`.`materials` ( `job_no`,`name`, `quantity` ) VALUES ('$jobNo', 'mat', '$Mat', '$qun' )";
    $rst1=mysqli_query($conn,$sql1);

    if($f == ""){
        if($rst){
            header('Location:section.php');
        }
        else{
            echo "error";
        }
    }

    if($f != ""){
        $fDate = date("Y-m-d");
        $sql2 = "UPDATE job set finished_date='$fDate' where job_no = '$jobNo'";
        $rst2=mysqli_query($conn,$sql2);

        $sql3 = "SELECT man_hrs, mach_hrs, extra FROM subjob WHERE job_no = '$jobNo'";
        $rst3 = mysqli_query($conn,$sql3);
        $mnHr = 0;
        $mcHr = 0;
        $ex = 0;
        while($row = mysqli_fetch_assoc($rst3)){
            $mnHr = $mnHr + $row['man_hrs'];
            $mcHr = $mcHr + $row['mach_hrs'];
            $ex = $ex + $row['extra'];
        }  

        $sql7 = "SELECT man_hrs, mach_hrs, extra FROM job WHERE job_no = '$jobNo'";
        $rst7 = mysqli_query($conn,$sql7);
        $row1 = mysqli_fetch_assoc($rst7);
        $mn = $row1['man_hrs'];
        $mch = $row1['mach_hrs'];
        $eex = $row1['extra'];

        $mnHr = $mnHr + $mn;
        $mcHr = $mcHr + $mch;
        $ex = $ex + $eex;

        $sql4 = "UPDATE job set man_hrs='$mnHr' , mach_hrs='$mcHr' , extra='$ex' where job_no='$jobNo'";
        $rst4=mysqli_query($conn,$sql4);

        $sql5 = "INSERT INTO account (job_no) VALUES ('$jobNo')";
        $rst5=mysqli_query($conn,$sql5);

        $msg = "New Finished Job : ".$jobNo;
        $mDate = date("Y-m-d");
        $sql6 = "INSERT INTO messages (fr,t,type,content,mDate) VALUES ('$secCode','ACC','notification','$msg','$mDate')";
        $rst6=mysqli_query($conn,$sql6);

        if($rst2 && $rst3 && $rst4 && $rst5 && $rst6){
           header('Location:section.php');
        }
        else{
            echo "error";
        }
    }
 
   
    
//echo $nMH."--".$nMcnH;
   // echo $Mat."--".$qun."--".$upr;
?>