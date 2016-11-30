<?php
include '../config.php';
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $query1=("SELECT * FROM materials WHERE id='$id'");
    $result=mysqli_query($conn,$query1);
    $row=mysqli_fetch_array($result);
    if (isset($_POST['update']))
    {
        $serial_no=$_POST['serial_no'];
        $material=$_POST['mat_name'];
        $quantity=$_POST['quantity'];
        $unit_price=$_POST['unit_price'];
        $stock=$_POST['stock'];
        $query="UPDATE materials SET cerial_no='$serial_no', material_name='$material',quantity='$quantity',unit_price='$unit_price',stock_availability='$stock' WHERE id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
            header('location:settings.php');
        }
    }

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
    <link rel="stylesheet" type="text/css" href="../CSS/regForm.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">

</head>

<body class="body">
<?php include 'adHeader.php'; ?>

<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
    <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <div class="form-area">
            <div class="topBar"><center>Update Materaial Details</center></div><br>
            <dl>
                <div class="list">
                    <dt><div class="form-fields">Serial No </div><div class="form-dots">:</div></dt>
                    <dd><div class="form-inputs"><input type="text" id="serial_no" name="serial_no" value="<?php echo $row['cerial_no']?>"/></div></dd>
                </div><br>
                <div class="list">
                    <dt><div class="form-fields">Material Name</div><div class="form-dots">:</div></dt>
                    <dd><div class="form-inputs"><input type="text" id="mat_name" name="mat_name" value="<?php echo $row['material_name']?>"/></div></dd>
                </div><br>
                <div class="list">
                    <dt><div class="form-fields">Quantity</div><div class="form-dots">:</div></dt>
                    <dd><div class="form-inputs"><input type="text" id="quantity" name="quantity"  value="<?php echo $row['quantity']?> "/></div></dd>
                </div><br>
                <div class="list">
                    <dt><div class="form-fields">Unit Price</div><div class="form-dots">:</div></dt>
                    <dd><div class="form-inputs"><input type="text" id="unit_price" name="unit_price"   value="<?php echo $row['unit_price']?> "/></div></dd>
                </div><br>
                <div class="list">
                    <dt><div class="form-fields">Stock Availability</div><div class="form-dots">:</div></dt>
                    <dd><div class="form-inputs"><input type="text" id="stok" name="stock"  value="<?php echo $row['stock_availability']?>"  /></div></dd>
                </div><br>
                <div class="list">
                    <center><input type="submit" value="Update" name="update"> </center>
                </div><br>
        </div>
    </form>
</div>
