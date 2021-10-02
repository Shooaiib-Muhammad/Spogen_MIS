<?php
include_once('./Panel/config.php');
if(isset($_SESSION['UserID'])){
	$UserID=$_SESSION['UserID'];

if(isset($_REQUEST['chngpasword'])){

 $oldPwd=$_REQUEST['oldpwd'];
//Echo "<br>";
 $newPwd=$_REQUEST['newpwd'];
//Echo "<br>";
 $retypePwd=$_REQUEST['retypepasswd']; 

//Echo "<br>";
 $UserID;
 $query = "SELECT        TOP (100) PERCENT UserID, LoginName, Password,Status
FROM             dbo.tbl_User_Logins
WHERE        (UserID = $UserID) and (Password='$oldPwd')"; 

		 $perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);

                $Dooo = sqlsrv_query($conn,$query,$perem,$option);
                $row=sqlsrv_num_rows($Dooo);
                if($row>0){
                	
                	$rows=sqlsrv_num_rows($Dooo);

			$row=sqlsrv_fetch_array($Dooo);
				
 //Echo "Old PAsssword is  mmatch";
  
       
      if($oldPwd!=$newPwd){

  if($oldPwd!=$retypePwd){

 if($newPwd==$retypePwd){

  $newpassword = $retypePwd;
 $sql="UPDATE   dbo.tbl_User_Logins SET Password='$newpassword' where UserID='$UserID'"; 

 $perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);

                $sqqql = sqlsrv_query($conn,$sql,$perem,$option);
 if($sqqql)
 {
 	$_SESSION['id']=1;
 $_SESSION['msg']="Your Password has been changed Sussessfully ";

header('location:changePassword.php');
}
  else
{
	$_SESSION['id']=2;
  $_SESSION['msg']="Sorry Password can not Be changed"; 
   header('location: changePassword.php');
}
       }else{
       	$_SESSION['id']=2;
       $_SESSION['msg']="New Password and confirm Password does not match";
       header('location: changePassword.php');
}

 }else{
 	$_SESSION['id']=2;
	 $_SESSION['msg']="Don't Use your Old Password";
	  header('location: changePassword.php');
}
        
 }
 else{
 	$_SESSION['id']=2;
    $_SESSION['msg']="Don't Use your Old Password";
     header('location: changePassword.php');
 }

}else{
	
	$_SESSION['id']=2;
   $_SESSION['msg']="Your Old Password does not match";
    header('location: changePassword.php');
}

}
}

include_once("./Footer/footer.php")

?> 


