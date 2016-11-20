<?php

include '../config.php';
//get the username  
$nic = $_REQUEST["q"];

//mysql query to select field username if it's equal to the username that we check '  
$result = "SELECT * FROM customer WHERE NIC = '$nic'";  
 
$inp = new DatabaseCon($conn);
$inpResult = $inp->getConnection($result);
//if number of rows fields is bigger them 0 that means it's NOT available '  
if(mysqli_num_rows($inpResult)>0){  
    //and we send 0 to the ajax request 
    $resultRow= $inp->getoutput($inpResult);
    $name = $resultRow['name'];
    $contact = $resultRow['contact_no'];
    $email = $resultRow['email'];
    $address = $resultRow['address'];
    $ary = array($name,$contact,$email,$address);
    echo json_encode($ary);   
}

?>