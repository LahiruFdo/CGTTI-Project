<?php
	session_start();

	include_once ("config.php");

	function check_input($r){
	$r=strip_tags($r);
	$r=stripslashes($r);
	$r=mysql_real_escape_string($r);
	return $r;
	}

	if (isset($_POST['username'],$_POST['password'])){
		if($_POST['username']=="" || $_POST['password']==""){
			header('Location: index.php');
			exit();
		}
		$uname = $_POST['username'];
		$pw = $_POST['password'];
		$pw = md5($pw);

		$squery1 = mysqli_query($conn, "SELECT * FROM officer WHERE uname = '$uname' ");
		$pwData = mysqli_fetch_array($squery1, MYSQLI_ASSOC);
		$squery2 = mysqli_query($conn, "SELECT * FROM officer WHERE pw = '$pw' ");
		$userData = mysqli_fetch_array($squery2, MYSQLI_ASSOC);


		if (mysqli_num_rows($squery1)==1) {
			if (mysqli_num_rows($squery2)>0) {
				if($pwData["pw"] == $pw ){
					$section=$pwData['section'];
					$name=$pwData['name'];
	  				$_SESSION['section']=$section;
	  				$_SESSION['user']=$name;
                    //if the user is Job Officer.
					if($section=="JO"){
						// echo "ok";
						header('Location: jobOffice/jobOffice1.php');
					}
                    else if($section=="ACC"){
						header('Location: Account/account.php');
					}
					else if ($section=="WE"){
						header('Location: Account.php');
					}
                    else{
                        /*have to improve code for logging different user*/
                        header('Location: section/section.php');
                        //logging to different users
                    }
				}
				else{
					echo "<script type = \"text/javascript\">
					alert(\"Invalid password\");
					window.location = (\"index.php\")
					</script>";
				}
			}
			else{
				echo "<script type = \"text/javascript\">
				alert(\"Invalid password\");
				window.location = (\"index.php\")
				</script>";
			}
		}
	}
	else{
		echo "<script type = \"text/javascript\">
		alert(\"Invalid password\");
		window.location = (\"index.php\")
		</script>";
	}
?>