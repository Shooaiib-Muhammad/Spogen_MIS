<?php
include_once('./Panel/config.php');
if(isset($_SESSION['userStus'])){
 $Status=$_SESSION['userStus'];
if ($Status==1) {
include('./Menu/BtmNav.php'); 
$Month=date('m');
$Year=date('Y');
$Day=date('d');
//$CurrentDate="2019-05-31";
$CurrentDate=$Year.'-'.$Month.'-'.$Day;
?>
<script src="./js/Jquery1.js"></script>
<script type="text/javascript">
     function Myfunction(){
    var Domain=$("#Data").val();
    $.post("QCSummaryBagDate.php",{Date: Domain},function(data, status){
       $("#Tabel").html(data);
   });
    }
</script>
<style type="text/css">
 table {
        display: block;
        overflow-x: auto;
        
    }
</style>
<?php
if(isset($_REQUEST['submit'])){

 
   
    //$PONumber=$_REQUEST['PONumber'];
    $POCode=$_REQUEST['POCode'];
?>
<form method="POST" action="POWise.php">

<div class="col-md-4">
<div class="form-group">
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Gloves PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="POCode">
<option   value="<?php Echo  $POCode;?>"><?php Echo  $POCode;?></option>
<option   value="All">All</option>
<?php


$Query="SELECT        TOP (100) PERCENT POCode, PO
FROM            dbo.tbl_Pro_PO_H
ORDER BY PO DESC";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Do = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Do)){
  $PO=$Data['POCode'];
?>

<option   value="<?php Echo  $PO;?>"><?php Echo  $PO;?></option>
<?php

}
?>
</select>
</div>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
    <br>
<button type="submit" id="submit" name="submit" class="btn btn-primary " ><i class=" fa fa-search"></i> Search</button></div>
</div>

</form>
<?php
if ($_REQUEST['POCode']=='All'){
  ?>
  
  <div class="col-md-12" >
  
  
  
  <table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
  <thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
  <tr style="width: 100%">
  <td colspan="13" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Gloves Production </b></td>
  </tr>
  <tr style="width: 100%">
  <td colspan="5" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
  <td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
  <td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
  </tr>
  <tr> 
      <th  style="text-align: center">Date</th>
  <th  style="text-align: center">PONO</th>
  <th  style="text-align: center">Article</th>
  <th  style="text-align: center">Size</th>
  <th  style="text-align: center">Client</th>
  <th  style="text-align: center">Inspected</th>
  <th  style="text-align: center">Accepted</th>
  <th  style="text-align: center">Rejected</th>
  <th  style="text-align: center">RFT</th>
  <th  style="text-align: center">Inspected</th>
  <th  style="text-align: center">Accepted</th>
  <th  style="text-align: center">Rejected</th>
  <th  style="text-align: center">RFT</th>
  </tr>
  </thead>
  <?php
 
  
      $Query=" SELECT        ArtCode, POCode, ClientName, SUM(PassRight) AS PassRight,
       SUM(Pass) AS Pass, SUM(leftFail) AS leftFail, ArtSize, SUM(RightFail) AS RightFail,
        CONVERT(Varchar, DateName, 103) AS Date
     FROM            dbo.View_Spg_prd_detail_datewise
     GROUP BY ArtCode, ClientName, ArtSize, POCode, CONVERT(Varchar, DateName, 103)";
  
  $perem=array();
  $option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
  $Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
  
  While($Data=sqlsrv_fetch_Array($Doo1)){
    $Date=$Data['Date'];
  $ArtCode=$Data['ArtCode'];
  $ArtSize=$Data['ArtSize'];
  $POCode=$Data['POCode'];
  $ClientName=$Data['ClientName'];
  $PassLeft=$Data['Pass'];
  $PassRight=$Data['PassRight'];
  $leftFailD=$Data['leftFail'];
  $RightFailD=$Data['RightFail'];
  $LeftChecked=$PassLeft+$leftFailD;
  $RightChecked=$PassRight+$RightFailD;
  if($LeftChecked==0){
    $RftLeftData=0;
  }else{
    $RftLeftData=$PassLeft/$LeftChecked;
  }
  $RftLeft=$RftLeftData*100;
  
  
  if($RightChecked==0){
    $RftRightData=0;
  }else{
    $RftRightData=$PassRight/$RightChecked;
  }
  $RftRight=$RftRightData*100;
  ?>
  <tbody>
  <tr>
  <th><?php echo $Date; ?></th>
  <th><?php echo $POCode; ?></th>

  <th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
  <th  style="text-align: center ;" ><?php echo $ArtSize; ?></th>
  <th  style="text-align: center ;" ><?php echo $ClientName; ?></th>
  <th  style="text-align: center ;color: #00cc00" ><?php echo round($LeftChecked)?></th>
  <th  style="text-align: center ;color: #00cc00" ><?php echo round($PassLeft)?></th>
  <th  style="text-align: center ;color: #00cc00" ><?php echo round($leftFailD)?></th>
  <th  style="text-align: center;color: #00cc00"><?php echo round($RftLeft)?>%</th>
  <th  style="text-align: center;color: #ff3333"><?php echo round($RightChecked)?></th>
  <th  style="text-align: center; color: #ff3333"><?php echo round($PassRight)?></th>
  <th  style="text-align: center ;color: #ff3333" ><?php echo round($RightFailD)?></th>
  <th  style="text-align: center;color: #ff3333"><?php echo round($RftRight)?>%</th>
  </tr>
  <?php }
  ?>
  <?php
 
  
 $Query="SELECT        SUM(PassRight) AS PassRight, SUM(Pass) AS Pass,
  SUM(leftFail) AS leftFail, SUM(RightFail) AS RightFail
 FROM            dbo.View_Spg_prd_detail_datewise";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Doo1)){

$PassLeft=$Data['Pass'];
$PassRight=$Data['PassRight'];
$leftFailD=$Data['leftFail'];
$RightFailD=$Data['RightFail'];
$LeftChecked=$PassLeft+$leftFailD;
$RightChecked=$PassRight+$RightFailD;
if($LeftChecked==0){
$RftLeftData=0;
}else{
$RftLeftData=$PassLeft/$LeftChecked;
}
$RftLeft=$RftLeftData*100;


if($RightChecked==0){
$RftRightData=0;
}else{
$RftRightData=$PassRight/$RightChecked;
}
$RftRight=$RftRightData*100;
?>
<tbody>
<tr>
<th colspan="5">Total:</th>

<th  style="text-align: center ;color: #00cc00" ><?php echo round($LeftChecked)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($PassLeft)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($leftFailD)?></th>
<th  style="text-align: center;color: #00cc00"><?php echo round($RftLeft)?>%</th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RightChecked)?></th>
<th  style="text-align: center; color: #ff3333"><?php echo round($PassRight)?></th>
<th  style="text-align: center ;color: #ff3333" ><?php echo round($RightFailD)?></th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RftRight)?>%</th>
</tr>
<?php }
?>
  </tbody>
  </table>
  </div>
  <?php
}else{


?>

<div class="col-md-12" >



<table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
<tr style="width: 100%">
<td colspan="12" style="background-color:#0074D9;text-align: center; color: #fff;"><b><?php Echo $POCode;?> Gloves Production </b></td>
</tr>
<tr style="width: 100%">
<td colspan="4" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
<td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
<td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
</tr>
<tr>
<!-- <th  style="text-align: center">PONO</th> -->
<th  style="text-align: center">Article</th>
<th  style="text-align: center">Size</th>
<th  style="text-align: center">Client</th>
<th  style="text-align: center">Inspected</th>
<th  style="text-align: center">Accepted</th>
<th  style="text-align: center">Rejected</th>
<th  style="text-align: center">RFT</th>
<th  style="text-align: center">Inspected</th>
<th  style="text-align: center">Accepted</th>
<th  style="text-align: center">Rejected</th>
<th  style="text-align: center">RFT</th>
</tr>
</thead>
<?php


     $Query="SELECT        ArtCode,  ClientName, SUM(PassRight) AS PassRight, SUM(Pass) AS Pass, 
  SUM(leftFail) AS leftFail, ArtSize, SUM(RightFail) AS RightFail
  FROM            dbo.View_Spg_prd_detail_datewise
  WHERE        (POCode = N'$POCode') GROUP BY ArtCode, ClientName, ArtSize";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Doo1)){
$ArtCode=$Data['ArtCode'];
$ArtSize=$Data['ArtSize'];
//$POCode=$Data['POCode'];
$ClientName=$Data['ClientName'];
$PassLeft=$Data['Pass'];
$PassRight=$Data['PassRight'];
$leftFailD=$Data['leftFail'];
$RightFailD=$Data['RightFail'];
$LeftChecked=$PassLeft+$leftFailD;
$RightChecked=$PassRight+$RightFailD;
if($LeftChecked==0){
  $RftLeftData=0;
}else{
  $RftLeftData=$PassLeft/$LeftChecked;
}
$RftLeft=$RftLeftData*100;


if($RightChecked==0){
  $RftRightData=0;
}else{
  $RftRightData=$PassRight/$RightChecked;
}
$RftRight=$RftRightData*100;
?>
<tbody>
<tr>
<!-- <th><?php echo $POCode; ?></th> -->
<th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
<th  style="text-align: center ;" ><?php echo $ArtSize; ?></th>
<th  style="text-align: center ;" ><?php echo $ClientName; ?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($LeftChecked)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($PassLeft)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($leftFailD)?></th>
<th  style="text-align: center;color: #00cc00"><?php echo round($RftLeft)?>%</th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RightChecked)?></th>
<th  style="text-align: center; color: #ff3333"><?php echo round($PassRight)?></th>
<th  style="text-align: center ;color: #ff3333" ><?php echo round($RightFailD)?></th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RftRight)?>%</th>
</tr>
<?php }
?>
<?php
 
  
 $Query="SELECT        SUM(PassRight) AS PassRight, SUM(Pass) AS Pass, SUM(leftFail) AS leftFail, SUM(RightFail) AS RightFail
 FROM            dbo.View_Spg_prd_detail_datewise
 WHERE        (POCode = N'$POCode')";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Doo1)){

$PassLeft=$Data['Pass'];
$PassRight=$Data['PassRight'];
$leftFailD=$Data['leftFail'];
$RightFailD=$Data['RightFail'];
$LeftChecked=$PassLeft+$leftFailD;
$RightChecked=$PassRight+$RightFailD;
if($LeftChecked==0){
$RftLeftData=0;
}else{
$RftLeftData=$PassLeft/$LeftChecked;
}
$RftLeft=$RftLeftData*100;


if($RightChecked==0){
$RftRightData=0;
}else{
$RftRightData=$PassRight/$RightChecked;
}
$RftRight=$RftRightData*100;
?>
<tbody>
<tr>
<th colspan="3">Total:</th>

<th  style="text-align: center ;color: #00cc00" ><?php echo round($LeftChecked)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($PassLeft)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($leftFailD)?></th>
<th  style="text-align: center;color: #00cc00"><?php echo round($RftLeft)?>%</th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RightChecked)?></th>
<th  style="text-align: center; color: #ff3333"><?php echo round($PassRight)?></th>
<th  style="text-align: center ;color: #ff3333" ><?php echo round($RightFailD)?></th>
<th  style="text-align: center;color: #ff3333"><?php echo round($RftRight)?>%</th>
</tr>
<?php }
?>
</tbody>
</table>
</div>
<?php
}
    
}else{
    
?>

<form method="POST" action="POWise.php">



<div class="col-md-4">
<div class="form-group">
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Gloves PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="POCode">
<option   value="All">All</option>
<?php


$Query="SELECT        TOP (100) PERCENT POCode, PO
FROM            dbo.tbl_Pro_PO_H
ORDER BY PO DESC";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Do = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Do)){
  $PO=$Data['POCode'];
?>

<option   value="<?php Echo  $PO;?>"><?php Echo  $PO;?></option>
<?php

}
?>
</select>
</div>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
    <br>
<button type="submit" id="submit" name="submit" class="btn btn-primary " ><i class=" fa fa-search"></i> Search</button></div>
</div>

</form>
<?php

}

?>
</div>
<script src="./js/Canvas.js"></script>
</div>   
<?php
include_once("./Footer/footer.php");
}
?>
<link href=""></link>
<script>
  $(document).ready( function () {
 
    $('#table').DataTable(
   { 
  
       dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            }
        ],
      "ordering":false,
      "pageLength":10,
      "searching":false,
      "LengthChange":true,
      "oLanguage":{"sEmptyTable":"Data Is Not Available Yet!"},
    
    }


      );
} );
</script>
<?php
}else{
header("location:./index.php");
}
?>