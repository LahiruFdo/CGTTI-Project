<?php
include '../config.php';
session_start();
if (isset($_GET['id'])){

}
?>
<!DOCTYPE html>
<html>
<head>

    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
    <script>

    </script>

</head>

<body class="body">
<?php include 'adHeader.php'; ?>
<div class="pageArea">
    <div class="page-area1" style="width:49%;">
        <div class="windowBttn">
            <b>Ongoing Jobs By Category</b>
        </div>
        <div class="profInfo">
            <?php

            $sql = "SELECT job_no,job_typ,sec_code,rDate,name FROM jobservce, section WHERE ( jobservce.sec_code = section.code AND gatePass='F') ORDER BY job_typ DESC";

            $query = mysqli_query($conn,$sql);

            if($result = $query){
                $count = mysqli_num_rows($result);
                if ($count >0){
                    echo "<table><tr><th> Job No </th><th> Section </th><th> Job Type </th><th> Registered Date </th>";
                    while($row= mysqli_fetch_assoc($result)){
                        $a = $row["job_no"]; $b = $row["name"]; $c=$row["job_typ"]; $d = $row["rDate"];

                        echo 	"<tr><td><a href='../jobOffice/JOviewjob.php?id=$a'>" . $a.
                            "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" . $b.
                            "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" . $c.
                            "</a></td><td><a href='../jobOffice/JOviewjob.php?id=$a'>" . $d .
                            "</a></td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "No ongoing Jobs at the moment";
                }
            }
            ?>
        </div><br><br>
    </div>
</div>
</body>
</html>
