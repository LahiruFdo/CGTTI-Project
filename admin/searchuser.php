<?php
if(isset($_GET['searchItem'])){
    $input = $_GET['searchItem'];
    if($input == ""){
        header('location:JOview.php');
    }
}
else{
    header('location:viewuser.php');
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/view.css">
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
    <link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">

</head>

<body class="body">
<?php include 'adHeader.php'; ?>
<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
    <h1 class="title">Job officer team</h1>

    <div class="maindiv">

        <div class="divD">


            <ul><li>  <a href="#" id="b1">New User</a></li></ul>
            <form action="searchuser.php" method="GET">
                <div class="search-button"><button id="b" type="submit">GO</button></div>
                <div class="search" style="width:30%;">

                    <div class="searchName" style="width:55%;">Search By Section</div>
                    <div class="searchBar" style="width:44%;"><input id="search" name="searchItem" type="text" placeholder="Enter Section"/></div>

                </div>
            </form>
            <div class="searchResults">

                <?php
                if($input!="") {
                    include '../config.php';
                    $sql = "SELECT * FROM officer WHERE section LIKE '%$input%'";
                    if ($result = mysqli_query($conn,$sql)) {
                        $count = mysqli_num_rows($result);
                        if($count >0){

                            while($row = mysqli_fetch_object($result)) {
                                ?>
                                <div class="card-container">
                                    <div class="cover">
                                        <div class="user"><?php echo "<img src='../images/$row->photo'>" ?></div>
                                    </div>
                                    <table>
                                        <tr>

                                            <td>Name:</td> <td><?php echo $row->name;?></td></tr>
                                        <tr>
                                            <td>NIC No:</td> <td><?php echo $row->nic_no; ?></td></tr>
                                        <td>Contact No:</td> <td><?php echo $row->contact_no; ?></td></tr>
                                        <td>Address:</td> <td><?php echo $row->address; ?></td></tr>
                                        <td>E-mail:</td> <td><?php echo $row->e_mail; ?></td></tr>
                                        <tr><td>Position:</td><td> <?php echo $row->position;?></td></tr>
                                        <tr><td>Section:</td><td> <?php echo $row->section;?></td></tr>
                                        <tr><td> <?php echo"<a href='updateuser.php?ide=$row->nic_no'>Update User</a>"?></td>
                                            <td> <?php echo"<a href='deleteuser.php?ide=$row->nic_no'>Delete User</a>"?></td></tr>
                                    </table>

                                </div>
                                <?php
                            }
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
