
<?php
include '../config.php';
$name=$_POST['name'];
$nic=$_POST['nic_no'];
$contact_no=$_POST['contact_no'];
$address=$_POST['address'];
$email=$_POST['e_mail'];
$position=$_POST['position'];
$section=$_POST['section'];
$uname=$_POST['uname'];
$pw=$_POST['pw'];
try {
    $target_dir = "../images";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if (isset($_POST['save'])) {
        $result=$conn->query("SELECT * FROM officer WHERE section='$section'");
        $row=$result->fetch_array(MYSQLI_BOTH);
        if($result->num_rows>0){
            $error="Already exists a section head";
        }
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check != false) {
            echo "File is an image-" . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

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
    }
    elseif (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        //$image=$_FILES["photo"]["name"];
        $query = "INSERT INTO officer(name,nic_no,contact_no,address,e_mail,position,section,uname,pw,photo) VALUES ('$name','$nic','$contact_no','$address','$email','$position','$section','$uname','$pw','$target_file')";
        $result = mysqli_query($conn, $query);

    } else {
        echo "Error while loading files";
    }
}
catch(Exception $e){
    echo $e;
}
if ($result) {
    header('location:viewuser.php');

}

?>