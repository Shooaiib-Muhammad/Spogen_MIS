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

 
    $StartDate=$_REQUEST['Sdate'];
    // Echo "<br>";
    $SYear=substr($StartDate,0,4);
        //echo "<br>";
    $SMonth=substr($StartDate,5,2);
        //echo "<br>";
    $SDay=substr($StartDate,-2,2);
    $Sdate=$SDay.'/'.$SMonth.'/'.$SYear;
    Echo "<br>";
    $EndDate=$_REQUEST['EDate'];
    $EYear=substr($EndDate,0,4);
        //echo "<br>";
    $EMonth=substr($EndDate,5,2);
        //echo "<br>";
    $EDay=substr($EndDate,-2,2);
    Echo "<br>";
       $Edate=$EDay.'/'.$EMonth.'/'.$EYear;
     Echo "<br>";
    $StartDateeee=$SYear.'-'.$SMonth.'-'.$SDay;
    $EndDateeee=$EYear.'-'.$EMonth.'-'.$EDay;
    $PONumber=$_REQUEST['PONumber'];
    $POCode=$_REQUEST['POCode'];
?>
<form method="POST" action="POWisePrdReports.php" style="margin-top: -50px;">
<div class="col-md-2">
<div class="form-group">
<label for="Date" ><i class="fas fa-calendar-alt"></i>  Start Date:</label>
<input type="Date"  name="Sdate" id="Data" class="form-control" value="<?php Echo $StartDateeee;?>"  
style="border: 1px solid #e6e6e6; width:100%; margin-left: 5px; border-radius:5px;">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label for="Date" ><i class="fas fa-calendar-alt"></i>  End Date:</label>
<input type="Date"  name="EDate" id="Data" class="form-control"
 value="<?php Echo $EndDateeee;?>"  
 style="border: 1px solid #e6e6e6; width:100%; margin-left: 5px; border-radius:5px;">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Bags PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="PONumber">
<option   value="<?php Echo $PONumber;?>"><?php Echo $PONumber;?></option>
<option   value="All">All</option>
<?php


$Query="SELECT        PONumber
FROM            dbo.View_PPS_VS_Head1
GROUP BY PONumber";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Do = sqlsrv_query($conn2,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Do)){
  $PO=$Data['PONumber'];
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
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Gloves PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="POCode">
<option   value="<?php Echo  $POCode;?>"><?php Echo  $POCode;?></option>
<option   value="All">All</option>
<?php


$Query="SELECT        POCode
FROM            dbo.View_Spg_prd_detail_datewise
GROUP BY POCode";

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
if ($_REQUEST['PONumber']=='All'){
  ?>
  <div class="col-md-12" >
  <table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
  <thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
  <tr style="width: 100%">
  <td colspan="11" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Bags  Production (<?php echo $Sdate;?>) To (<?php echo $Edate;?>)</b></td>
  </tr>
  <tr>
  <th  style="text-align: center">Date</th>
  <th  style="text-align: center">PONO</th>
  <th  style="text-align: center">Article</th>
  <th  style="text-align: center">Size</th>
  <th  style="text-align: center">Color</th>
  <th  style="text-align: center">Model No</th>
  <th  style="text-align: center">Working No</th>
  <th  style="text-align: center">Inspected</th>
  <th  style="text-align: center">Accepted</th>
  <th  style="text-align: center">Rejected</th>
  <th  style="text-align: center">RFT</th>
  </tr>
  </thead>
  <?php
  
  
    $Query="SELECT     PONumber,   CONVERT(Varchar, Date, 103) AS Date, ArticleColor, SUM(InsQty)
    AS InsQty, SUM(DefQty) AS DefQty, SUM(PackQty) AS PackQty, ModelName, WorkingNo, ArticleNo, Size
   FROM            dbo.View_PPS_VS_Head1
   WHERE        (Date BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102)
   AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102)) 
   GROUP BY ArticleColor, ModelName, WorkingNo, ArticleNo, Size, CONVERT(Varchar, Date, 103),PONumber";
   
   $perem=array();
   $option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
   $Doo1 = sqlsrv_query($conn2,$Query,$perem,$option);
  While($Data=sqlsrv_fetch_Array($Doo1)){
  $ArtCode=$Data['ArticleNo'];
  $Size=$Data['Size'];
  $PONumber=$Data['PONumber'];
  $ModelName=$Data['ModelName'];
  $WorkingNo=$Data['WorkingNo'];
  $ArticleColor=$Data['ArticleColor'];
  $InsQty=$Data['InsQty'];
  $PackQty=$Data['PackQty'];
  $DefQty=$Data['DefQty'];
  if($InsQty==0 or $PackQty==0){
    $RFT=0;
  }else{
    $RFT=($PackQty/$InsQty)*100;
  }
  $Date=$Data['Date'];
  ?>
  <tbody>
  <tr>
  <th><?php echo $Date; ?></th>
  <th><?php echo $PONumber; ?></th>
  <th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
  <th  style="text-align: center ;" ><?php echo $Size; ?></th>
  <th  style="text-align: center ;" ><?php echo $ArticleColor; ?></th>
  <th  style="text-align: center ;" ><?php echo $ModelName; ?></th>
  <th  style="text-align: center ;" ><?php echo $WorkingNo; ?></th>
  <th  style="text-align: center ;color: blue" ><?php echo round($InsQty)?></th>
  <th  style="text-align: center ;color: #00cc00" ><?php echo round($PackQty)?></th>
  <th  style="text-align: center ;color: #ff3333" ><?php echo round($DefQty)?></th>
  <th  style="text-align: center;color: orange"><?php echo round($RFT)?>%</th>
  
  </tr>
  <?php }
  
  
   $select1="SELECT        SUM(InsQty) AS InsQty, SUM(DefQty) AS DefQty, SUM(PackQty) AS PackQty
   FROM            dbo.View_PPS_VS_Head1
   WHERE        (Date BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102) AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102))" ; 
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $result1 = sqlsrv_query($conn2, $select1 , $params, $options ); 
  $get1 = sqlsrv_num_rows($result1);
  if($get1>0){
  $Data1=sqlsrv_fetch_Array($result1);
   $InsQty1=$Data1['InsQty']; 
  $DefQty1=$Data1['DefQty'];
  $PackQty1=$Data1['PackQty'];
  if($InsQty1==0 or $PackQty1==0){
    $RFT1=0;
  }else{
    $RFT1=($PackQty1/$InsQty1)*100;
  }
  }else{
  $InsQty1=0;
  $DefQty1=0;
  $PackQty1=0;
  $RFT1=0;
  }
  
  
  
    ?>
  <tr style="background-color:#282828; color:#fff; font-size: 20px;">
  <td colspan="7">Total:</td>
  
  <td style="text-align: center"><?php echo round($InsQty1)?></td>
  <td style="text-align: center"><?php echo round($PackQty1)?></td>
  <td style="text-align: center"><?php echo round($DefQty1)?></td>
  <td style="text-align: center"><?php echo round($RFT1)?>%</td>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="col-md-12" >
  
  
  
  <table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
  <thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
  <tr style="width: 100%">
  <td colspan="12" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Gloves Production (<?php echo $Sdate;?>) To (<?php echo $Edate;?>)</b></td>
  </tr>
  <tr style="width: 100%">
  <td colspan="4" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
  <td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
  <td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
  </tr>
  <tr>
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
  
  
     $Query="SELECT        ArtCode, POCode, ClientName, SUM(PassRight) AS PassRight, SUM(Pass) AS Pass, 
    SUM(leftFail) AS leftFail, ArtSize, SUM(RightFail) AS RightFail
    FROM            dbo.View_Spg_prd_detail_datewise
    WHERE      
    (DateName BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102)
     AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102))
    GROUP BY ArtCode, ClientName, ArtSize, POCode";
  
  $perem=array();
  $option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
  $Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
  
  While($Data=sqlsrv_fetch_Array($Doo1)){
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
<td colspan="11" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Bags  Production (<?php echo $Sdate;?>) To (<?php echo $Edate;?>)</b></td>
</tr>
<tr>
<th  style="text-align: center">Date</th>
<th  style="text-align: center">PONO</th>
<th  style="text-align: center">Article</th>
<th  style="text-align: center">Size</th>
<th  style="text-align: center">Color</th>
<th  style="text-align: center">Model No</th>
<th  style="text-align: center">Working No</th>
<th  style="text-align: center">Inspected</th>
<th  style="text-align: center">Accepted</th>
<th  style="text-align: center">Rejected</th>
<th  style="text-align: center">RFT</th>
</tr>
</thead>
<?php


  $Query="SELECT     PONumber,   CONVERT(Varchar, Date, 103) AS Date, ArticleColor, SUM(InsQty)
  AS InsQty, SUM(DefQty) AS DefQty, SUM(PackQty) AS PackQty, ModelName, WorkingNo, ArticleNo, Size
 FROM            dbo.View_PPS_VS_Head1
 WHERE        (Date BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102)
 AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102)) AND (PONumber = N'$PONumber')
 GROUP BY ArticleColor, ModelName, WorkingNo, ArticleNo, Size, CONVERT(Varchar, Date, 103),PONumber";
 
 $perem=array();
 $option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
 $Doo1 = sqlsrv_query($conn2,$Query,$perem,$option);
While($Data=sqlsrv_fetch_Array($Doo1)){
$ArtCode=$Data['ArticleNo'];
$Size=$Data['Size'];
$PONumber=$Data['PONumber'];
$ModelName=$Data['ModelName'];
$WorkingNo=$Data['WorkingNo'];
$ArticleColor=$Data['ArticleColor'];
$InsQty=$Data['InsQty'];
$PackQty=$Data['PackQty'];
$DefQty=$Data['DefQty'];
if($InsQty==0 or $PackQty==0){
  $RFT=0;
}else{
  $RFT=($PackQty/$InsQty)*100;
}
$Date=$Data['Date'];
?>
<tbody>
<tr>
<th><?php echo $Date; ?></th>
<th><?php echo $PONumber; ?></th>
<th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
<th  style="text-align: center ;" ><?php echo $Size; ?></th>
<th  style="text-align: center ;" ><?php echo $ArticleColor; ?></th>
<th  style="text-align: center ;" ><?php echo $ModelName; ?></th>
<th  style="text-align: center ;" ><?php echo $WorkingNo; ?></th>
<th  style="text-align: center ;color: blue" ><?php echo round($InsQty)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($PackQty)?></th>
<th  style="text-align: center ;color: #ff3333" ><?php echo round($DefQty)?></th>
<th  style="text-align: center;color: orange"><?php echo round($RFT)?>%</th>

</tr>
<?php }


 $select1="SELECT        SUM(InsQty) AS InsQty, SUM(DefQty) AS DefQty, SUM(PackQty) AS PackQty
 FROM            dbo.View_PPS_VS_Head1
 WHERE        (PONumber='$PONumber') and  (Date BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102) AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102))" ; 
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result1 = sqlsrv_query($conn2, $select1 , $params, $options ); 
$get1 = sqlsrv_num_rows($result1);
if($get1>0){
$Data1=sqlsrv_fetch_Array($result1);
 $InsQty1=$Data1['InsQty']; 
$DefQty1=$Data1['DefQty'];
$PackQty1=$Data1['PackQty'];
if($InsQty1==0 or $PackQty1==0){
  $RFT1=0;
}else{
  $RFT1=($PackQty1/$InsQty1)*100;
}
}else{
$InsQty1=0;
$DefQty1=0;
$PackQty1=0;
$RFT1=0;
}



  ?>
<tr style="background-color:#282828; color:#fff; font-size: 20px;">
<td colspan="7">Total:</td>

<td style="text-align: center"><?php echo round($InsQty1)?></td>
<td style="text-align: center"><?php echo round($PackQty1)?></td>
<td style="text-align: center"><?php echo round($DefQty1)?></td>
<td style="text-align: center"><?php echo round($RFT1)?>%</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-12" >



<table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
<tr style="width: 100%">
<td colspan="12" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Gloves Production (<?php echo $Sdate;?>) To (<?php echo $Edate;?>)</b></td>
</tr>
<tr style="width: 100%">
<td colspan="4" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
<td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
<td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
</tr>
<tr>
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


   $Query="SELECT        ArtCode, POCode, ClientName, SUM(PassRight) AS PassRight, SUM(Pass) AS Pass, 
  SUM(leftFail) AS leftFail, ArtSize, SUM(RightFail) AS RightFail
  FROM            dbo.View_Spg_prd_detail_datewise
  WHERE        (POCode = N'$POCode') AND 
  (DateName BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102)
   AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102))
  GROUP BY ArtCode, ClientName, ArtSize, POCode";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Doo1)){
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
</tbody>
</table>
</div>
<?php
}
    
}else{
    
?>

<form method="POST" action="POWisePrdReports.php">
<div class="col-md-2">
<div class="form-group">
<label for="Date" ><i class="fas fa-calendar-alt"></i>  Start Date:</label>
<input type="Date"  name="Sdate" id="Data" class="form-control" value="<?php Echo $CurrentDate;?>"  
style="border: 1px solid #e6e6e6; width:100%; margin-left: 5px; border-radius:5px;">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label for="Date" ><i class="fas fa-calendar-alt"></i>  End Date:</label>
<input type="Date"  name="EDate" id="Data" class="form-control"
 value="<?php Echo $CurrentDate;?>"  style="border: 1px solid #e6e6e6; width:100%; margin-left: 5px; border-radius:5px;">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Bags PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="PONumber">
<option   value="All">All</option>
<?php


$Query="SELECT        PONumber
FROM            dbo.View_PPS_VS_Head1
GROUP BY PONumber";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Do = sqlsrv_query($conn2,$Query,$perem,$option);

While($Data=sqlsrv_fetch_Array($Do)){
  $PO=$Data['PONumber'];
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
<div class="form-line">
     <label for="email"><i class="fas fa-calendar-alt"></i>Select Gloves PO:</label>
<select class="form-control show-tick" data-live-search="true" 
id="SelectBox" style="width: 100%;" name="POCode">
<option   value="All">All</option>
<?php


$Query="SELECT        POCode
FROM            dbo.View_Spg_prd_detail_datewise
GROUP BY POCode";

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
}else{
header("location:./index.php");
}
?>