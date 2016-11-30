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
            <?php
            include '../config.php';
            /* $sql="SELECT * FROM officer";
             $result=mysqli_query($conn,$sql);
             while ($row = mysqli_fetch_assoc($result)) {
                 echo "<ul>";

                 echo "<li><b><a href=\"viewuser.php?id={$row['section']}\">{$row['section']}</a></b></li>";



             }
             echo "</ul>";*/
            ?>

        </div>
        <?php
        $num1=$num;
        $num2=$num1+3;

        /*if (isset($_GET['id'])) {
              $id = $_GET['id'];*/
        $sql1="SELECT * FROM officer ";
        if ($result = mysqli_query($conn,$sql1)) {
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($row1 = mysqli_fetch_object($result)) {
                    ?>
                    <div class="card-container">
                        <div class="cover">
                            <div class="user"><?php echo "<img src='../images/$row1->photo'>" ?></div>
                        </div>
                        <table>
                            <tr>

                                <td>Name:</td> <td><?php echo $row1->name;?></td></tr>
                            <tr>
                                <td>NIC No:</td> <td><?php echo $row1->nic_no; ?></td></tr>
                            <td>Contact No:</td> <td><?php echo $row1->contact_no; ?></td></tr>
                            <td>Address:</td> <td><?php echo $row1->address; ?></td></tr>
                            <td>E-mail:</td> <td><?php echo $row1->e_mail; ?></td></tr>
                            <tr><td>Position:</td><td> <?php echo $row1->position;?></td></tr>
                            <tr><td>Section:</td><td> <?php echo $row1->section;?></td></tr>
                            <tr><td> <?php echo"<a href='updateuser.php?ide=$row1->nic_no'>Update User</a>"?></td>
                                <td> <?php echo"<a href='deleteuser.php?ide=$row1->nic_no'>Delete User</a>"?></td></tr>
                        </table>

                    </div>

                    <?php

                }
                if($count==3){echo "<div class='links'><a href='viewuser.php?id=$num2'><u>View More</u></a></div>";}}
            else {
                echo "<center>No more Jobs</center>";
            }
        }


        ?>

    </div>

    <div id="newuser" class="msgWindow">
        <div class="msgBody">
            <span id="c1" class="close">x</span>
            <br>

            <div>
                <form action="newuser.php" method="post" enctype="multipart/form-data">
                    <div class="form-area">
                        <div class="topBar"><center>Register as a new user</center></div><br>
                        <dl>
                            <div class="list">
                                <dt><div class="form-fields">Name </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="name" name="name" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Nic No </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="nic_no" name="nic_no" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Contact_no</div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="contact_no" name="contact_no" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">E Mail </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="email" name="e_mail" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Address </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="address" name="address" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Position </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="position" name="position" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Section </div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="section" name="section" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">User Name</div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="text" id="uname" name="uname" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Password</div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="password" id="pw" name="pw" input required="required"/></div></dd>
                            </div><br>
                            <div class="list">
                                <dt><div class="form-fields">Photo</div><div class="form-dots">:</div></dt>
                                <dd><div class="form-inputs"><input type="file" id="file" name="photo" input required="required"/></div></dd>
                            </div><br>
                        </dl>
                        <div class="list">
                            <div class="form-inputs"><center><input type="submit" value="Save" name="save"> </center></div>
                        </div><br>
                    </div>
                </form>
            </div>



        </div>

    </div>
    <script>
        var msgBox = document.getElementById('newuser');
        var btn1 = document.getElementById("b1");
        var close1 = document.getElementById("c1");

        btn1.onclick = function() {
            msgBox.style.display = "block";
        }
        close1.onclick = function() {
            msgBox.style.display = "none";
        }
    </script>
</body>
</html>