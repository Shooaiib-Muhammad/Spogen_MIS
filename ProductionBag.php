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



 $data_points = array();
 $select="SELECT        Date, OPQty, InsQty, DefQty, PackQty, ErrorCode32, ErrorCode31, ErrorCode30, ErrorCode29, ErrorCode27, ErrorCode28, ErrorCode26, ErrorCode25, ErrorCode24, ErrorCode23, ErrorCode22, ErrorCode21, ErrorCode20, ErrorCode19, ErrorCode18, ErrorCode17, ErrorCode16, ErrorCode15, ErrorCode14, ErrorCode13,ErrorCode12, ErrorCode11, ErrorCode10, ErrorCode9, ErrorCode8, ErrorCode7, ErrorCode6, ErrorCode5, ErrorCode4, ErrorCode3, ErrorCode2, ErrorCode1, RFT,ModelName, WorkingTime, WorkingNo, ArticleNo, PONumber, Size
FROM            dbo.View_PPS_VS_Head1
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn2,$select);     
while($row = sqlsrv_fetch_array($result))
{        
$point = array("label" => "Production" , "y" => $row['PackQty']);
array_push($data_points, $point);        
}
$data_points1 = array();
 $select="SELECT        Date, OPQty, InsQty, DefQty, PackQty, ErrorCode32, ErrorCode31, ErrorCode30, ErrorCode29, ErrorCode27, ErrorCode28, ErrorCode26, ErrorCode25, ErrorCode24, ErrorCode23, ErrorCode22, ErrorCode21, ErrorCode20, ErrorCode19, ErrorCode18, ErrorCode17, ErrorCode16, ErrorCode15, ErrorCode14, ErrorCode13,ErrorCode12, ErrorCode11, ErrorCode10, ErrorCode9, ErrorCode8, ErrorCode7, ErrorCode6, ErrorCode5, ErrorCode4, ErrorCode3, ErrorCode2, ErrorCode1, RFT,ModelName, WorkingTime, WorkingNo, ArticleNo, PONumber, Size
FROM            dbo.View_PPS_VS_Head1
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn2,$select);     
while($row = sqlsrv_fetch_array($result))
{ 

$RFT=$row['RFT'];
       
$point = array("label" => "RFT" , "y" => $RFT);
array_push($data_points1, $point);        
}
 
?>
<script src="./js/Jquery1.js"></script>
<script type="text/javascript">
     function Myfunction(){
    var Domain=$("#Data").val();
    $.post("ProductionBagDate.php",{Date: Domain},function(data, status){
       $("#Tabel").html(data);
   });
    }
</script>
<script type="text/javascript">

window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
animationEnabled: true,
  //exportEnabled: true,
  title:{
    text: "Bags Production"
  },
   axisY:{
    title:"Bags Production"
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

var chart = new CanvasJS.Chart("chartContainer2", {
  animationEnabled: true,
  //exportEnabled: true,
  title:{
    text:"Bags RFT"
  },
   axisY:{
    title:"Bags RFT"
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
color:"orange", 
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

}
</script>
</script>
<?php
 $Query="SELECT        Date, ArticleColor
, OPQty, InsQty, DefQty, PackQty, ErrorCode32, ErrorCode31, ErrorCode30, ErrorCode29, ErrorCode27, ErrorCode28, ErrorCode26, ErrorCode25, ErrorCode24, ErrorCode23, ErrorCode22, ErrorCode21, ErrorCode20, ErrorCode19, ErrorCode18, ErrorCode17, ErrorCode16, ErrorCode15, ErrorCode14, ErrorCode13,ErrorCode12, ErrorCode11, ErrorCode10, ErrorCode9, ErrorCode8, ErrorCode7, ErrorCode6, ErrorCode5, ErrorCode4, ErrorCode3, ErrorCode2, ErrorCode1, RFT,ModelName, WorkingTime, WorkingNo, ArticleNo, PONumber, Size
FROM            dbo.View_PPS_VS_Head1
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn2,$Query,$perem,$option);
?>
<label for="email" style="margin-left: 5px;"><i class="fas fa-calendar-alt"></i>  Select Date:</label>
<input type="Date"  name="Sdate" id="Data" class="form-control" value="<?php Echo $CurrentDate;?>" onchange="Myfunction()"  style="border: 1px solid #e6e6e6; width:25%; margin-left: 5px; border-radius:5px;">
<div id="Tabel">
<div class="col-md-4"></div>
<div class="col-md-4">
<table class="table table-hover " style="border: 1px white solid; width:90%; ">
<thead style=" background: #282828; color: white; font-size: 20px; ">
<th style="text-align: center;"> Today's Bags Production</th>
  </thead>
</table>
</div><div class="col-md-4"></div>
<div class="col-md-12" >



<table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; " >
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
<!-- <tr style="width: 100%">
<td colspan="13" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Weekly Production</b></td>
</tr> -->
<!-- <tr style="width: 100%">
<td colspan="4" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
<td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
<td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
</tr> -->
<tr>
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
$RFT=$Data['RFT'];
?>
<tbody>
<tr>
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


 $select1="SELECT        Date, OPQty, InsQty, DefQty, PackQty, RFT
FROM            dbo.DailyQry
WHERE        (Date = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result1 = sqlsrv_query($conn2, $select1 , $params, $options ); 
$get1 = sqlsrv_num_rows($result1);
if($get1>0){
$Data1=sqlsrv_fetch_Array($result1);
 $InsQty1=$Data1['InsQty']; 
$DefQty1=$Data1['DefQty'];
$PackQty1=$Data1['PackQty'];
$RFT1=$Data1['RFT'];
}else{
$InsQty1=0;
$DefQty1=0;
$PackQty1=0;
$RFT1=0;
}



  ?>
<tr style="background-color:#282828; color:#fff; font-size: 20px;">
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: center"><?php echo round($InsQty1)?></td>
<td style="text-align: center"><?php echo round($PackQty1)?></td>
<td style="text-align: center"><?php echo round($DefQty1)?></td>
<td style="text-align: center"><?php echo round($RFT1)?>%</td>
</tr>
</tbody>
</table>
</div>
        
<div class="col-md-6">
<div id="chartContainer" style="height: 350px; width: 100%;"></div>
</div>
<div class="col-md-6">
<div id="chartContainer2" style="height: 350px; width: 100%;"></div>

<script src="./js/Canvas.js"></script>
</div>
 </div>     
<?php
include_once("./Footer/footer.php");
}
}else{
header("location:./index.php");
}
?>