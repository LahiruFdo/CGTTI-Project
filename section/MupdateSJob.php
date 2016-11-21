<?php 

session_start();
   include_once '../config.php';  
        
        $sjobNo = $_POST['jno'];
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
    $sql="UPDATE subjob set man_hrs='$nMH' , mach_hrs='$nMcnH' , extra='$nEx' where subjob_no='$sjobNo'";
    $rst=mysqli_query($conn,$sql);
    /*$sql1 = "INSERT INTO `cgtti`.`materials` (`ID`, `code`, `name`, `quantity`, `job_no`) VALUES (NULL, '$code', '$Mat', '$qun', '$jobNo')";
    $rst1=mysqli_query($conn,$sql1);*/

    if($f != ""){
        $fDate = date("Y-m-d");
        $sql2 = "UPDATE subjob set finish_date='$fDate' where subjob_no = '$sjobNo'";
        $rst2=mysqli_query($conn,$sql2);
    }

    if($rst || $rst2){
        header('Location:section.php');
    }
    else{
        echo "error";
    }
    
?>