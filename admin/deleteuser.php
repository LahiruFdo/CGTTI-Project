<!DOCTYPE HTML>
<html>
<body>
<?php include '../config.php';
if (isset($_GET['ide']))
{
    $id=$_GET['ide'];
    $selectrw="SELECT photo FROM officer WHERE nic=$id";
    $result=mysqli_query($conn,$selectrw);
    $imageRow=mysqli_fetch_assoc($result);
    unlink("../images/".$imageRow['photo']);

    $query=$conn->prepare("DELETE FROM officer WHERE nic_no='$id'");
    $query->bind_param(':nic_no',$_GET['ide']);
    $query->execute();

    header('location:viewuser.php');
    echo "<script type = \"text/javascript\">
				alert(\"Record Successfully Deleted\");
				window.location = (\"viewuser.php\")
				</script>";


}



?>
</body>
</html>