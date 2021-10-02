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
$data_points = array();
$select="SELECT        ArtCode, POCode, ClientName, PassRight, Pass, leftFail, ArtSize, DateName, RightFail
FROM            dbo.View_Spg_prd_detail_datewise
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
while($row = sqlsrv_fetch_array($result))
{        
$point = array("label" => "Left Production" , "y" => $row['Pass']);
array_push($data_points, $point);        
}
$data_points1 = array();
 $select="SELECT        ArtCode, POCode, ClientName, PassRight, Pass, leftFail, ArtSize, DateName, RightFail
FROM            dbo.View_Spg_prd_detail_datewise
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
while($row = sqlsrv_fetch_array($result))
{ 
$leftFail=$row['leftFail'];
$Pass=$row['Pass'];
$TotalChecked=$Pass+$leftFail; 
if($TotalChecked==0){
  $RftData=0;
}else{
  $RftData=$Pass/$TotalChecked;
}
 $Rft=$RftData*100;       
$point = array("label" => "Left RFT" , "y" => $Rft);
array_push($data_points1, $point);        
}
$data_points2 = array();
 $select="SELECT        ArtCode, POCode, ClientName, PassRight, Pass, leftFail, ArtSize, DateName, RightFail
FROM            dbo.View_Spg_prd_detail_datewise
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
while($row = sqlsrv_fetch_array($result))
{        
$point = array("label" => "Right Production" , "y" => $row['PassRight']);
array_push($data_points2, $point);        
}
$data_points3 = array();
 $select="SELECT        ArtCode, POCode, ClientName, PassRight, Pass, leftFail, ArtSize, DateName, RightFail
FROM            dbo.View_Spg_prd_detail_datewise
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
while($row = sqlsrv_fetch_array($result))
{ 
$RightFail=$row['RightFail'];
$PassRight=$row['PassRight'];
$TotalChecked1=$PassRight+$RightFail; 
if($TotalChecked1==0){
 $RftData1=0;
}else{
$RftData1=$PassRight/$TotalChecked1;
}
$Rft1=$RftData1*100;      
$point = array("label" => "Right RFT" , "y" => $Rft1);
array_push($data_points3, $point);        
}
?>
<script src="./js/Jquery1.js"></script>
<script type="text/javascript">
     function Myfunction(){
    var Domain=$("#Data").val();
    $.post("ProductionGDate.php",{Date: Domain},function(data, status){
       $("#Tabel").html(data);
   });
    }
</script>
<script type="text/javascript">
var chart = new CanvasJS.Chart("chartContainer", {
animationEnabled: true,
  //exportEnabled: true,
  title:{
    text: "Left Production"
  },
   axisY:{
    title:"Left Production"
     },
  legend:{
    cursor: "pointer",
    fontSize: 16,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
  data: [
  {
type: "column",
yValueFormatString: "#",
indexLabel: "{y} ",
indexLabelFontSize: 15,  
name: "RFT",
// indexLabelOrientation: "vertical",
indexLabelPlacement: "top",
color:"#00cc00", 
dataPoints: <?php echo json_encode($data_points, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
function toggleDataSeries(e){
if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
e.dataSeries.visible = false;
  }
else{
e.dataSeries.visible = true;
  }
chart.render();
}
var chart = new CanvasJS.Chart("chartContainer1", {
  animationEnabled: true,
  //exportEnabled: true,
  title:{
    text: "Right Production"
  },
   axisY:{
   title:"Right Production"
     },
  legend:{
    cursor: "pointer",
    fontSize: 16,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
  data: [
  {
   type: "column",
        yValueFormatString: "#",
        indexLabel: "{y} ",
 indexLabelFontSize: 15, 
  name: "Efficiency",
// indexLabelOrientation: "vertical",
        indexLabelPlacement: "top",
       color:"#ff3333", 
    dataPoints: <?php echo json_encode($data_points2, JSON_NUMERIC_CHECK); ?>
  }]
});

chart.render();
function toggleDataSeries(e){
if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
e.dataSeries.visible = false;
  }
else{
e.dataSeries.visible = true;
  }
chart.render();
}
var chart = new CanvasJS.Chart("chartContainer2", {
  animationEnabled: true,
  //exportEnabled: true,
  title:{
    text:"Left RFT"
  },
   axisY:{
    title:"Left RFT"
     },
  legend:{
    cursor: "pointer",
    fontSize: 16,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
  data: [
  {
   type: "column",
        yValueFormatString: "#",
        indexLabel: "{y}% ",
 indexLabelFontSize: 15, 
  name: "Left RFT",
// indexLabelOrientation: "vertical",
indexLabelPlacement: "top",
color:"#00cc00", 
dataPoints: <?php echo json_encode($data_points1, JSON_NUMERIC_CHECK); ?>
  }]
});

chart.render();
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}

var chart = new CanvasJS.Chart("chartContainer3", {
  animationEnabled: true,
  title:{
    text:"Right RFT"
  },
   axisY:{
    title:"Right RFT"
     },
  legend:{
    cursor: "pointer",
    fontSize: 16,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
  data: [
 {
type: "column",
yValueFormatString: "#",
indexLabel: "{y}% ",
indexLabelFontSize: 15, 
name: "Production",
// indexLabelOrientation: "vertical",
 indexLabelPlacement: "top",
 color:"#ff3333", 
 dataPoints: <?php echo json_encode($data_points3, JSON_NUMERIC_CHECK); ?>
  }]
});

chart.render();
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}
</script>
<?php
 $Query="SELECT        ArtCode, POCode, ClientName, PassRight, Pass, leftFail, ArtSize, DateName, RightFail
FROM            dbo.View_Spg_prd_detail_datewise
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))";
$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
?>
<div id="Tabel">
<div class="col-md-4"></div>
<div class="col-md-4">
<table class="table table-hover " style="border: 1px white solid; width:90%; ">
<thead style=" background: #282828; color: white; font-size: 20px; ">
<th style="text-align: center;"><?php echo $Date;?> GLoves Production</th>
</thead>
</table>
</div><div class="col-md-4"></div>
<div class="col-md-12" >
<table  class="table table-bordered table-hover" style="font-size:18px; border: 4px    #282828 solid; " >
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px    #282828 solid;">
<!-- <tr style="width: 100%">
<td colspan="13" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Weekly Production</b></td>
</tr> -->
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
$selectTotal="SELECT        leftFail, leftPass, DateName, leftPass + leftFail AS TotalChecked
FROM            dbo.View_left_Prd
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))"; 
$resultT=sqlsrv_query($conn,$selectTotal);     
$rowT = sqlsrv_fetch_array($resultT);
$leftFailT=$rowT['leftFail'];
$leftPassT=$rowT['leftPass'];
$TotalCheckedT=$rowT['TotalChecked']; 
if($TotalCheckedT==0){
  $RftDataT=0;
}else{
  $RftDataT=$leftPassT/$TotalCheckedT;
}
$RftT=$RftDataT*100;
$select1="SELECT        RightFail, RightPass, DateName
FROM            dbo.View_Right_Prd
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))";
$result1=sqlsrv_query($conn,$select1);     
$row1 = sqlsrv_fetch_array($result1);
$RightFail1=$row1['RightFail'];
$RightPass1=$row1['RightPass']; 
$TotalChecked1=$RightPass1+$RightFail1;
if($TotalChecked1==0){
 $RftData1=0;
}else{
$RftData1=$RightPass1/$TotalChecked1;
}
$Rft1=$RftData1*100;
?>
<tr style="background-color:#282828; color:#fff; font-size: 20px;">
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: center"><?php echo round($TotalCheckedT)?></td>
<td style="text-align: center"><?php echo round($leftPassT)?></td>
<td style="text-align: center"><?php echo round($leftFailT)?></td>
<td style="text-align: center"><?php echo round($RftT)?>%</td>
<td style="text-align: center"><?php echo round($TotalChecked1)?></td>
<td style="text-align: center"><?php echo round($RightPass1)?></td>
<td style="text-align: center"><?php echo round($RightFail1)?></td>
<td style="text-align: center"><?php echo round($Rft1)?>%</td>
</tr>
</tbody>
</table>
</div>       
<div class="col-md-6">
<div id="chartContainer" style="height: 350px; width: 100%;"></div>
</div>
<div class="col-md-6">
<div id="chartContainer1" style="height: 350px; width: 100%;"></div>
</div>
<div class="col-md-6">
<div id="chartContainer2" style="height: 350px; width: 100%;"></div>
</div>
<div class="col-md-6">
 <div id="chartContainer3" style="height: 350px; width: 100%; "></div>
<script src="./js/Canvas.js"></script>
</div>
 </div>     
<?php } ?>