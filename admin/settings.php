<?php
include '../config.php';
if (isset($_POST['save'])){
    $serial_no=$_POST['serial_no'];
    $material=$_POST['material'];
    $quantity=$_POST['quantity'];
    $unit_price=$_POST['unit_price'];
    $job_no=$_POST['job_no'];
    $stock=$_POST['stock'];

    $query="INSERT INTO materials(cerial_no,material_name,quantity,unit_price,job_no,stock_availability)VALUES
 ('$serial_no','$material','$quantity','$unit_price','$job_no','$stock')";
    $result1=mysqli_query($conn,$query);
    if ($result1){
        header('location:settings.php');
    }
    else {
        echo "Error occour while loading data";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
    <link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">

</head>
<body class="body">
<?php include 'adHeader.php'; ?>

<div class="pageArea">
    <div class="page-area1" style="width:49%;">
        <div class="windowBttn">
            <b>Material Details</b>
        </div>
        <div class="windowBttn">
            <a href="#" id="b1"><b>Add Material</b></a>
        </div>
        <div class="profInfo">
            <?php
            $sql="SELECT * FROM materials";
            $con = new DatabaseCon($conn);
            if($result = $con->getConnection($sql)){
            $count = $con->getRowCount($result);
            if ($count >0) {
                echo "<table><tr><th>Serial No</th><th>Material Name</th><th>Unit Price</th><th>Stok Availability</th></tr>";
                while ($row = $con->getoutput($result)) {
                    $a = $row["cerial_no"];
                    $b = $row["material_name"];
                    $d = $row["unit_price"];
                    $e = $row["stock_availability"];

                    echo "<tr><td><a href='viewmat.php?id=$a'>" . $a .
                        "</a></td><td><a href='viewmat.php?id=$a'>" . $b .
                        "</a></td><td><a href='viewmat.php?id=$a'>" . $d .
                        "</a></td><td><a href='viewmat.php?id=$a'>" . $e .
                        "</a></td><td><a href='delete_mat.php?id=$a'>Delete</a></td>
                                     <td><a href='update_mat.php?id=$a' >Update</a></td></tr>";

                }
                echo "</table>";
            }
            else{
                "No material has added to the database";
            }
            }

            ?>

        </div>
    </div>
    <div id="newuser" class="msgWindow">
        <div class="msgBody">
            <span id="c1" class="close">x</span>
            <br>
            <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                <div class="form-area">
                    <div class="topBar"><center>Add Materials</center></div><br>
                    <dl>
                        <div class="list">
                            <dt><div class="form-fields">Serial No </div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="serial_no" name="serial_no" input required="required"/></div></dd>
                        </div><br>
                        <div class="list">
                            <dt><div class="form-fields">Material </div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="material" name="material" input required="required"/></div></dd>
                        </div><br>
                        <div class="list">
                            <dt><div class="form-fields">Quantity </div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="quantity" name="quantity" input required="required"/></div></dd>
                        </div><br>
                        <div class="list">
                            <dt><div class="form-fields">Unit Price </div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="unit_price" name="unit_price" input required="required"/></div></dd>
                        </div><br>
                        <div class="list">
                            <dt><div class="form-fields">Job No </div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="job_no" name="job_no" /></div></dd>
                        </div><br>
                        <div class="list">
                            <dt><div class="form-fields">Stock Availability</div><div class="form-dots">:</div></dt>
                            <dd><div class="form-inputs"><input type="text" id="stock" name="stock" input required="required"/></div></dd>
                        </div><br>
                        <div class="list">
                            <div class="topBar"><center><input type="submit" value="Save" name="save"> </center></div>
                        </div><br>

                    </dl>
                </div>
            </form>
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
