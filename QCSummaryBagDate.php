<?php
include_once('./Panel/config.php');
if(isset($_POST['Date'])){
 $DAte = $_POST['Date'];

  //echo "<br>";
$Year=substr($DAte,0,4);
  //echo "<br>";
$Month=substr($DAte,5,2);
  //echo "<br>";
$Day=substr($DAte,-2,2);
$CurrentDate=$Year.'-'.$Month.'-'.$Day;
$Date=$Day.'-'.$Month.'-'.$Year;

 $Query="SELECT        Date, OPQty, InsQty, DefQty, PackQty, ErrorCode32, ErrorCode31, ErrorCode30, ErrorCode29, ErrorCode27, ErrorCode28, ErrorCode26, ErrorCode25,ErrorCode24, ErrorCode23, ErrorCode22, ErrorCode21, ErrorCode20, ErrorCode19, ErrorCode18, ErrorCode17, ErrorCode16, ErrorCode15, ErrorCode14, ErrorCode13, ErrorCode12, ErrorCode11, ErrorCode10, ErrorCode9, ErrorCode8, ErrorCode7, ErrorCode6, ErrorCode5, ErrorCode4, ErrorCode3, ErrorCode2, ErrorCode1, RFT,  ModelName, WorkingTime, WorkingNo, ArticleNo, PONumber, Size
FROM            dbo.View_PPS_VS_Head1
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn2,$Query,$perem,$option);
?>



<div id="Tabel">
<div class="col-md-4"></div>
<div class="col-md-4">
<table class="table table-hover " style="border: 1px white solid; width:100%; ">
<thead style=" background: #282828; color: white; font-size: 20px; ">
<th style="text-align: center;"><?php echo $Date;?> GLoves Defects </th>
  </thead>
</table>
</div><div class="col-md-4"></div>
<div class="col-md-12" >
<table  class="table table-bordered table-hover" id="one" style="font-size:18px; border: 4px   #282828 solid; ">
<thead style="background-color:  #0074D9;color:white; height: 10%; border: 1px   #282828 solid;">
<!-- <tr style="width: 100%">
<td colspan="13" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Weekly Production</b></td>
</tr> -->
<!-- <tr style="width: 100%">
<td colspan="1" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
<td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
<td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
</tr> -->
<tr>
<!-- <th  style="text-align: center">Hour</th> -->
<th  style="text-align: center">PONO</th>
<th  style="text-align: center">Article</th>
<th  style="text-align: center">Size</th>
<th  style="text-align: center">Model No</th>
<th  style="text-align: center">Working No</th>
<th  style="width: 10%;">Puckering</th>
<th  style="width: 10%;">Open Seam/Binding</th>
<th  style="width: 10%;">Bartack Missing</th>
<th  style="width: 10%;">Carry Handle Pull Out/Centralize</th>
<th  style="width: 10%;">Wrong(Care Security Label)</th>
<th  style="width: 10%;">Shoulder Pull Out/Binding</th>
<th  style="width: 10%;">Panel Tearing</th>
<th  style="width: 10%;">Pin Hole</th>
<th  style="width: 10%;">Logo Up and Down</th>
<th  style="width: 10%;">Wrong color Matching</th>
<th  style="width: 10%;">Ziper/Slider Defect</th>
<th  style="width: 10%;">Bottom Panel Secateurs</th>
<th  style="width: 10%;">Less or more Stiching per Inch</th>
<th  style="width: 10%;">Stain</th>
<th  style="width: 10%;">Dust</th>
<th  style="width: 10%;">Printing Problem</th>
<th  style="width: 10%;">Thread matching</th>
<th  style="width: 10%;">Lighter unused</th>
<th  style="width: 10%;">Chalk Mark</th>
<th  style="width: 10%;">Lining Pullout from Binding</th>
<th  style="width: 10%;">Lose Stitching</th>
<th  style="width: 10%;">Mesh Pull Out</th>
<th  style="width: 10%;">Pullar Missing</th>
<th  style="width: 10%;">P Wire not According to Sample</th>
<th  style="width: 10%;">Uneven Folding</th>
<th  style="width: 10%;">Others</th>
<th  style="width: 10%;">Misc</th>
<th  style="width: 10%;">Foam Matiral Defect</th>
<th  style="width: 10%;">Zipper Matiral Defect</th>
<th  style="width: 10%;">TPE Matiral Defect</th>
<th  style="width: 10%;">PE Wire Matiral Defect</th>
<th  style="width: 10%;">Fabric Matiral Defect</th>
</tr>
</thead>
<?php
While($Data=sqlsrv_fetch_Array($Doo1)){
  $ArtCode=$Data['ArticleNo'];
$Size=$Data['Size'];
$PONumber=$Data['PONumber'];
$ModelName=$Data['ModelName'];
$WorkingNo=$Data['WorkingNo'];
$ErrorCode1=$Data['ErrorCode1'];
$ErrorCode2=$Data['ErrorCode2'];
$ErrorCode3=$Data['ErrorCode3'];
$ErrorCode4=$Data['ErrorCode4'];
$ErrorCode5=$Data['ErrorCode5'];
$ErrorCode6=$Data['ErrorCode6'];
$ErrorCode7=$Data['ErrorCode7'];
$ErrorCode8=$Data['ErrorCode8'];
$ErrorCode9=$Data['ErrorCode9'];
$ErrorCode10=$Data['ErrorCode10'];
$ErrorCode11=$Data['ErrorCode11'];
$ErrorCode12=$Data['ErrorCode12'];
$ErrorCode13=$Data['ErrorCode13'];
$ErrorCode14=$Data['ErrorCode14'];
$ErrorCode15=$Data['ErrorCode15'];
$ErrorCode16=$Data['ErrorCode16'];
$ErrorCode17=$Data['ErrorCode17'];
$ErrorCode18=$Data['ErrorCode18'];
$ErrorCode19=$Data['ErrorCode19'];
$ErrorCode20=$Data['ErrorCode20'];
$ErrorCode21=$Data['ErrorCode21'];
$ErrorCode22=$Data['ErrorCode22'];
$ErrorCode23=$Data['ErrorCode23'];
$ErrorCode24=$Data['ErrorCode24'];
$ErrorCode25=$Data['ErrorCode25'];
$ErrorCode26=$Data['ErrorCode26'];
$ErrorCode27=$Data['ErrorCode27'];
$ErrorCode28=$Data['ErrorCode28'];
$ErrorCode29=$Data['ErrorCode29'];
$ErrorCode30=$Data['ErrorCode30'];
$ErrorCode31=$Data['ErrorCode31'];
$ErrorCode32=$Data['ErrorCode32'];
?>
<tbody>
<tr>
  <th><?php echo $PONumber; ?></th>
<th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
<th  style="text-align: center ;" ><?php echo $Size; ?></th>
<th  style="text-align: center ;" ><?php echo $ModelName; ?></th>
<th  style="text-align: center ;" ><?php echo $WorkingNo; ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCode1); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCode2); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCode3); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCode4); ?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode5)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode6)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode7)?></th>
<th  style="text-align: center; "><?php echo round($ErrorCode8)?></th>
<th  style="text-align: center; "><?php echo round($ErrorCode9)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode10)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode11)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode12)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode13)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode14)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode15)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode16)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode17)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode18)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode19)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode20)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode21)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode22)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode23)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode24)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode25)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode26)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode27)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode28)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode29)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode30)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCode31)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCode32)?></th>
</tr>
<?php } 
 $selectTotal="SELECT  SUM(ErrorCode27) AS ErrorCode27, SUM(ErrorCode28) AS ErrorCode28, SUM(ErrorCode26) AS ErrorCode26, SUM(ErrorCode25) AS ErrorCode25, SUM(ErrorCode24)  AS ErrorCode24, SUM(ErrorCode23) AS ErrorCode23, SUM(ErrorCode22) AS ErrorCode22, SUM(ErrorCode21) AS ErrorCode21, SUM(ErrorCode20) AS ErrorCode20, SUM(ErrorCode19) AS ErrorCode19, SUM(ErrorCode18) AS ErrorCode18, SUM(ErrorCode17) AS ErrorCode17, SUM(ErrorCode16) AS ErrorCode16, SUM(ErrorCode15)  AS ErrorCode15, SUM(ErrorCode14) AS ErrorCode14, SUM(ErrorCode13) AS ErrorCode13, SUM(ErrorCode12) AS ErrorCode12, SUM(ErrorCode11) AS ErrorCode11, SUM(ErrorCode10) AS ErrorCode10, SUM(ErrorCode9) AS ErrorCode9, SUM(ErrorCode8) AS ErrorCode8, SUM(ErrorCode7) AS ErrorCode7, SUM(ErrorCode6) AS ErrorCode6, SUM(ErrorCode5) AS ErrorCode5, SUM(ErrorCode4) AS ErrorCode4, SUM(ErrorCode3) AS ErrorCode3, SUM(ErrorCode2) AS ErrorCode2, SUM(ErrorCode1) AS ErrorCode1, SUM(ErrorCode32) AS ErrorCode32, SUM(ErrorCode31) AS ErrorCode31, SUM(ErrorCode30) AS ErrorCode30, SUM(ErrorCode29)  AS ErrorCode29
FROM            dbo.View_PPS_VS_Head1
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))
GROUP BY Date"; 
$resultT=sqlsrv_query($conn2,$selectTotal);     
$DataT = sqlsrv_fetch_array($resultT);
$ErrorCodeT1=$DataT['ErrorCode1'];
$ErrorCodeT2=$DataT['ErrorCode2'];
$ErrorCodeT3=$DataT['ErrorCode3'];
$ErrorCodeT4=$DataT['ErrorCode4'];
$ErrorCodeT5=$DataT['ErrorCode5'];
$ErrorCodeT6=$DataT['ErrorCode6'];
$ErrorCodeT7=$DataT['ErrorCode7'];
$ErrorCodeT8=$DataT['ErrorCode8'];
$ErrorCodeT9=$DataT['ErrorCode9'];
$ErrorCodeT10=$DataT['ErrorCode10'];
$ErrorCodeT11=$DataT['ErrorCode11'];
$ErrorCodeT12=$DataT['ErrorCode12'];
$ErrorCodeT13=$DataT['ErrorCode13'];
$ErrorCodeT14=$DataT['ErrorCode14'];
$ErrorCodeT15=$DataT['ErrorCode15'];
$ErrorCodeT16=$DataT['ErrorCode16'];
$ErrorCodeT17=$DataT['ErrorCode17'];
$ErrorCodeT18=$DataT['ErrorCode18'];
$ErrorCodeT19=$DataT['ErrorCode19'];
$ErrorCodeT20=$DataT['ErrorCode20'];
$ErrorCodeT21=$DataT['ErrorCode21'];
$ErrorCodeT22=$DataT['ErrorCode22'];
$ErrorCodeT23=$DataT['ErrorCode23'];
$ErrorCodeT24=$DataT['ErrorCode24'];
$ErrorCodeT25=$DataT['ErrorCode25'];
$ErrorCodeT26=$DataT['ErrorCode26'];
$ErrorCodeT27=$DataT['ErrorCode27'];
$ErrorCodeT28=$DataT['ErrorCode28'];
$ErrorCodeT29=$DataT['ErrorCode29'];
$ErrorCodeT30=$DataT['ErrorCode30'];
$ErrorCodeT31=$DataT['ErrorCode31'];
$ErrorCodeT32=$DataT['ErrorCode32'];
?>
<tr style="background-color:#282828; color:#fff; font-size: 18px;">
<td>Total:</td>
<td></td>
<td></td>
<td></td>
<td></td>
<th  style="text-align: center ;" ><?php echo Round($ErrorCodeT1); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCodeT2); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCodeT3); ?></th>
<th  style="text-align: center ;" ><?php echo Round($ErrorCodeT4); ?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT5)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT6)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT7)?></th>
<th  style="text-align: center; "><?php echo round($ErrorCodeT8)?></th>
<th  style="text-align: center; "><?php echo round($ErrorCodeT9)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT10)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT11)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT12)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT13)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT14)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT15)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT16)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT17)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT18)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT19)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT20)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT21)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT22)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT23)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT24)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT25)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT26)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT27)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT28)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT29)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT30)?></th>
<th  style="text-align: center ;"><?php echo round($ErrorCodeT31)?></th>
<th  style="text-align: center;"><?php echo round($ErrorCodeT32)?></th>
</tbody>
</table>
</div>    
<?php } ?>