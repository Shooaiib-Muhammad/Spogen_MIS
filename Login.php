<?php 
include_once ('panel/config.php');
//include_once("Css/_head.php");



?>
<?php
// $Username="Admin";
// $Pwd="Fsports@123";

// $Username1="Hassan";
// $Pwd1="Forward@123";

// $Username2="Kashif";
// $Pwd2="Forward@123";

if(isset($_REQUEST['Login'])){
 	$Name= $_REQUEST['username'];

	//echo "</br>";
	  $Password=$_REQUEST['password'];
	  $query="SELECT        UserID,Status, LoginName, Password
FROM            dbo.tbl_User_Logins
WHERE        (Status = 1) AND (LoginName = '$Name') AND (Password = '$Password')"; 

	// if($Username==$Name or $Username1==$Name or $Username2==$Name){
	// 	if($Pwd==$PAssword or $Pwd1==$PAssword or $Pwd2==$PAssword)
$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Run = sqlsrv_query($conn,$query,$perem,$option);
                       /// $newhiring_num_rows = sqlsrv_num_rows($Do);

$row=sqlsrv_num_rows($Run);
if($row>0){  
			$Data=sqlsrv_fetch_array($Run);
			$username=$Data['LoginName'];
			$UserID=$Data['UserID'];
			$Status=1;
			$_SESSION['UserID']=$UserID;
			 $_SESSION['userStus']=$Status;
		  $_SESSION['FirstName']=$FirstName;
          $_SESSION['lastName']=$lastName;
          $_SESSION['LoginName']=$Username;
			
			header('location:./Dashboard.php');
	}else{
		$_SESSION['msg']="Wrong Password or User Name ";
		header('location:./index.php');
		
	}
	
}

?>