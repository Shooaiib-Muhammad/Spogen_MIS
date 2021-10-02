<?php
include_once ('./panel/config.php');
if (isset($_SESSION['userStus'])) {
	unset($_SESSION['userStus']);

	header('location:./index.php');
}
else{
	header("location:./index.php");
}


?>