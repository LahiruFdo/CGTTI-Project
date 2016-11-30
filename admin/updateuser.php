<?php include '../config.php';
if(isset($_GET['ide']))
{
    $id=$_GET['ide'];
    try {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $nic = $_POST['nic_no'];
            $contact_no = $_POST['contact_no'];
            $email = $_POST['e_mail'];
            $address = $_POST['address'];
            $position = $_POST['position'];
            $section = $_POST['section'];
            $uname = $_POST['uname'];
            $pw = $_POST['pw'];
            $profile_pic=$_POST['curr_pic'];

            $target_dir = "../images";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if (isset($_FILES["photo"])) {

                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check != false) {
                    echo "File is an image-" . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if ($_FILES["photo"]["size"] > 300000) {
                        echo "Sorry you file is too large.";
                        $uploadOk = 0;
                    }
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded";
                    } else {
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
                        $profile_pic = $target_file;
                    }
                }

            }
            $query = "UPDATE officer set name='$name', nic_no='$nic', contact_no='$contact_no',e_mail='$email',address='$address',position='$position', section='$section', uname='$uname', pw='$pw',photo='$profile_pic'  WHERE nic_no='$id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header('location:viewuser.php');

            }
        }

    }
    catch(Exception $e){
        echo $e;
    }

    $query1="SELECT * FROM officer WHERE nic_no='$id'";
    $result1=mysqli_query($conn,$query1);
    $row=mysqli_fetch_array($result1);

}?>
<!DOCTYPE html>
<html>
<head>

    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/view.css">
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">

</head>

<body class="body">
<?php include 'adHeader.php'; ?>

<div class="pageArea" style="font-family: 'calibri','verdana'; padding-right:2%; padding-left:1.5%;">
    <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $_GET['ide']?>">
        <table>
            <tr><td>Name</td><td><input type="text" name="name" value="<?php echo $row['name']; ?>">
            <tr><td>NIC No</td><td><input type="text" name="nic_no" value="<?php echo $row['nic_no']; ?>">
            <tr><td>Contact No</td><td><input type="text" name="contact_no" value="<?php echo $row['contact_no']; ?>">
            <tr><td>Address</td><td><input type="text" name="address" value="<?php echo $row['address']; ?>">
            <tr><td>Email</td><td><input type="email" name="e_mail" value="<?php echo $row['e_mail']; ?>">
            <tr><td>Position</td><td><input type="text" name="position" value="<?php echo $row['position']; ?>">
            <tr><td>Section</td><td><input type="text" name="section" value="<?php echo $row['section']; ?>">
            <tr><td>Username</td><td><input type="text" name="uname" value="<?php echo $row['uname']; ?>">
            <tr><td>Password</td><td><input type="password" name="pw" value="<?php echo $row['pw']; ?>">
            <tr><td>Photo</td><td><input type="file" name="photo" value=""></td>
                <td><img src="<?php echo '../images/'.$row['photo']?>">
                    <input name="curr_pic" type="hidden" value="<?php echo '../images/'.$row['photo']?>">
        </table>
        <input type="submit" name="submit" value="Update">
    </form>
</div>
</body>
</html>