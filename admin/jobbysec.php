<?php
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
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
</head>

<body class="body">
<?php include 'adHeader.php'; ?>
<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
    <div class="windowBttn">
        <b>Ongoing Jobs By Section</b>
    </div>
    <div class="profInfo">
        <?php
        $num1 = 0;
        $num2 = $num1+10;
        include '../config.php';
        $sql = "SELECT job_no,job_typ,sec_code,details,rDate,name FROM jobservce, section WHERE (jobservce.sec_code = section.code AND gatePass='F' ) ORDER BY sec_code DESC LIMIT $num1,$num2 ";
        if ($result = mysqli_query($conn,$sql)) {
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                echo "<table><tr><th> Job No </th><th> Section Code </th><th> Section </th><th> Registered Date</th><th>Job Type</th><th>Job Description</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    $a=$row['job_no'];
                    $sc=$row['sec_code'];
                    $s=$row['name'];
                    $date=$row['rDate'];
                    $jt=$row['job_typ'];
                    $d=$row['details'];
                    echo "<tr><td><a href='../jobOffice/JOviewjob.php?id=$a'>" . $a.
                        "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" .$sc. 
                        "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" .$s.
                        "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" .$date.
                        "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>".$jt.
                        "</td><td><a href='../jobOffice/JOviewjob.php?id=$a'>".$d."</td></tr>";
                
                }

            }
            echo "</table>";
            if($count==10){echo "<div class='links'><a href='jobbysec.php?id=$num2'><u>View More</u></a></div>";}}
        else {
            echo "<center>No job found under the given sections</center>";
        }
        ?>
        </div>
    </div>
</body>
</html>