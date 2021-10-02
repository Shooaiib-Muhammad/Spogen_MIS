<?php
include_once ('./Panel/config.php');

 if(isset($_REQUEST['submit'])){
 $UserID=$_REQUEST['UserID'];
  
//$PWD=$_REQUEST['PWD'];
if (empty($_REQUEST['Status'])) {
    $WebStatus=0;

    # code...
}else {
    $WebStatus=1;
}
 if (empty($_REQUEST['Gear'])) {
    $Gear=0;

    # code...
}else {
    $Gear=1;
}


     $WebStatus;
  if (empty($_REQUEST['Veer'])) {
    $Veer=0;

    # code...
}else {
    $Veer=1;
}


     $Veer;


     //$HS;
     
     
   //   Echo "<br>";
   // Echo  $MSStatus;
     $Query="UPDATE tblUsers
   SET       WebStatus =  $WebStatus
   ,Gear= $Gear
   ,Veer = $Veer    
 WHERE UserID=$UserID";
$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
if(sqlsrv_query($conn,$Query,$perem,$option)){
header("location:User_Manual.php");
}else{
Echo "Sorry data Not Saved";
}
}
?>