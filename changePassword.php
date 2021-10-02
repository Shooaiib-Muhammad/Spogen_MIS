<!DOCTYPE html>
<html>
<head>
 <?php
include_once('./Panel/config.php');
if(isset($_SESSION['userStus'])){
 $Status=$_SESSION['userStus'];
include('./Menu/BtmNav.php');
?>

<div class="content-wrapper">
<br>
<div class="panel panel-primary" style="width:60%; margin-left: 120px;">
 <div class="panel-heading" style="background-color:#66b3ff;"><i class="fa fa-key"></i> Change Password </div>
<form  class="mainform"  method="post" action="changePwsd.php" enctype="multipart/form-data" >
     <?php
if(isset($_SESSION['msg']))
{
if(isset($_SESSION['id'])){
if($_SESSION['id']==1){
echo '<div class="alert alert-info " >
  <strong style="color:#282828;">Info! '  . $_SESSION['msg'] . 
' </strong>   </div>';
        }else{
             echo '<div class="alert alert-danger">
  <strong>Warning ! </strong>   '  . $_SESSION['msg'] .
'</div>';
        }
    }
   
unset($_SESSION['msg']);
 
}?>
<center>
<div class="form-group">
<?php
if(isset($_SESSION['UserID'])){
$UserID=$_SESSION['UserID'];
 $Query1="SELECT        TOP (100) PERCENT UserID,FirstName,lastName ,LoginName, Password,Status
FROM            dbo.tbl_User_Logins
WHERE        (UserID = $UserID)"; 
 $perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Dooo1 = sqlsrv_query($conn,$Query1,$perem,$option);
$rows=sqlsrv_num_rows($Dooo1);
$Data1=sqlsrv_fetch_array($Dooo1);

$LoginName=$Data1['LoginName']; 



?>
<label> <i class="fa fa-user"> </i> User Name: <?php Echo $LoginName;?></label>
</div>
<?php
}?>
</center>  
<div class="form-group" style="margin-left: 20px;">
<label > <i class="fa fa-lock"> </i>   Old Password:</label>
 <input type="password" placeholder="    Old Password" required="required" class="form-control" id="OldPassword" name="oldpwd" style="width: 80%; border:1px solid #347ab6; border-radius: 5px; ">
</div>
<div class="form-group" style="margin-left: 20px;">
<label> <i class="fa fa-lock"> </i> New Password:</label>
 <input type="password" required="required"  class="form-control" placeholder="    Password" id="NP" name="newpwd"style="width: 80%; border:1px solid #347ab6; border-radius: 5px; ">
</div>
<div class="form-group" style="margin-left: 20px;"> 
<label>  <i class="fa fa-lock"> </i> Confirm Password:</label>
<input type="password" required="required"  class="form-control" id="verifyP" placeholder="    Retype Password" name="retypepasswd" style="width: 80%; border:1px solid #347ab6; border-radius: 5px; ">
</div>
<div class="form-group" style="margin-left: 35%;">
<button type="submit" class="btn btn-success btn-md" name="chngpasword"  value="signup" id="save" style="background-color: #66b3ff;"><span><i class="fa fa-save" aria-hidden="true"> </i> Change Password</span></button>
  </div>
 </form>
</section>
   

  <!-- Content Wrapper. Contains page content --> 


</div>
<?php
include_once("./Footer/footer.php")
?>
</body>
</html>
<?php

}else{
header("location:./index.php");
}
     ?>