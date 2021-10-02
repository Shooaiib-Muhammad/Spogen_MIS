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
    $.post("QCSummaryDate.php",{Date: Domain},function(data, status){
       $("#Tabel").html(data);
   });
    }
</script>
<!-- <script type="text/javascript">
window.onload = function () {
var  chart =  new  CanvasJS.Chart("container", {
  animationEnabled: true,
  backgroundColor: "white",
   theme: "light2",
 
  title:{
    text: "Production",
  },
  data: [{
    type: "column",
    indexLabelFontColor: "#5A5757",
    indexLabelPlacement: "outside",   
  
     dataPoints: [
     { label:"Left", y: <?php echo  round($leftPass); ?>,color: "#99ff33", },
        { label:"Right", y: <?php echo  round($RightPass1); ?>, color: " #ff3333"}
  ],
   indexLabelFontSize: 20,
   indexLabel: "{y}"
  }]
});
chart.render();
var  chart =  new  CanvasJS.Chart("containerthree", {
  animationEnabled: true,
  backgroundColor: "white",
  
  theme: "light2",
  title:{
  text: "RFT(%)"
  },
  data: [{
    type: "column",
    indexLabelFontColor: "#5A5757",
    indexLabelPlacement: "outside",   
 
     dataPoints: [
     { label:"Left", y: <?php echo  round($Rft); ?>,color: "#99ff33" },
     { label:"Right", y: <?php echo round($Rft1); ?>, color: " #ff3333"}
       
  ],
   indexLabelFontSize: 20,
   indexLabel: "{y}%"
  }]
});
chart.render();
}
</script> -->
<?php
 $Query="SELECT        dbo.tbl_Pro_Processes.ProcessName, dbo.tbl_Pro_Process_Defect.DefectName, SUM(dbo.tbl_Pro_DailyPRD.Pass) AS Pass, SUM(dbo.tbl_Pro_DailyPRD.PrintingL) 
                         AS PrintingL, SUM(dbo.tbl_Pro_DailyPRD.PrintingR) AS PrintingR, SUM(dbo.tbl_Pro_DailyPRD.StitchingR) AS StitchingR, SUM(dbo.tbl_Pro_DailyPRD.StitchingL) 
                         AS StitchingL, SUM(dbo.tbl_Pro_DailyPRD.EmbossingR) AS EmbossingR, SUM(dbo.tbl_Pro_DailyPRD.EmbossingL) AS EmbossingL, 
                         SUM(dbo.tbl_Pro_DailyPRD.DyingR) AS DyingR, SUM(dbo.tbl_Pro_DailyPRD.DyingL) AS DyingL, SUM(dbo.tbl_Pro_DailyPRD.PassRight) AS PassRight
FROM            dbo.tbl_Pro_DailyPRD INNER JOIN
                         dbo.tbl_Pro_Process_Defect ON dbo.tbl_Pro_DailyPRD.DefectID = dbo.tbl_Pro_Process_Defect.DefectID INNER JOIN
                         dbo.tbl_Pro_Processes ON dbo.tbl_Pro_Process_Defect.ProcessID = dbo.tbl_Pro_Processes.ProcessID INNER JOIN
                         dbo.tbl_Inv_Tran_Date ON dbo.tbl_Pro_DailyPRD.DayID = dbo.tbl_Inv_Tran_Date.DayNo
WHERE        (dbo.tbl_Inv_Tran_Date.DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))
GROUP BY dbo.tbl_Pro_Processes.ProcessName, dbo.tbl_Pro_Process_Defect.DefectName";

$perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
?>

<label for="email" style="margin-left: 5px;"><i class="fas fa-calendar-alt"></i>  Select Date:</label>
<input type="Date"  name="Sdate" id="Data" class="form-control" value="<?php Echo $CurrentDate;?>" onchange="Myfunction()"  style="border: 1px solid #e6e6e6; width:25%; margin-left: 5px; border-radius:5px;">

<div id="Tabel">
<div class="col-md-4"></div>
<div class="col-md-4">
<table class="table table-hover " style="border: 1px white solid; width:100%; ">
<thead style=" background: #282828; color: white; font-size: 20px; ">
<th style="text-align: center;">Todays GLoves Defects </th>
  </thead>
</table>
</div><div class="col-md-4"></div>
<div class="col-md-12" >
<table  class="table table-bordered table-hover" style="font-size:18px; border: 4px   #282828 solid; ">
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
<!-- <tr style="width: 100%">
<td colspan="13" style="background-color:#0074D9;text-align: center; color: #fff;"><b>Weekly Production</b></td>
</tr> -->
<tr style="width: 100%">
<td colspan="1" style="background-color:#0074D9;text-align: center; color: #fff;"><b></b></td>
<td colspan="4" style="background-color:#608000;text-align: center; color: #fff;"><b>Left</b></td>
<td colspan="4" style="background-color:#ff3333;text-align: center; color: #fff;"><b>Right</b></td>
</tr>
<tr>
<th  style="text-align: center">Defect Name</th>
<th  style="text-align: center">Printing</th>
<th  style="text-align: center">Dying</th>
<th  style="text-align: center">Embossing</th>
<th  style="text-align: center">Stitching</th>
<th  style="text-align: center">Printing</th>
<th  style="text-align: center">Dying</th>
<th  style="text-align: center">Embossing</th>
<th  style="text-align: center">Stitching</th>
</tr>
</thead>
<?php
While($Data=sqlsrv_fetch_Array($Doo1)){
$DefectName=$Data['DefectName'];
$PrintingL=$Data['PrintingL'];
$StitchingL=$Data['StitchingL'];
$DyingL=$Data['DyingL'];
$EmbossingL=$Data['EmbossingL'];
$PrintingR=$Data['PrintingR'];
$StitchingR=$Data['StitchingR'];
$DyingR=$Data['DyingR'];
$EmbossingR=$Data['EmbossingR'];
?>
<tbody>
<tr>
<th><?php echo $DefectName; ?></th>
<th  style="text-align: center ;color: #00cc00"><?php echo round($PrintingL)?></th>
<th  style="text-align: center ;color: #00cc00"><?php echo round($DyingL)?> </th>
<th  style="text-align: center ;color: #00cc00"><?php echo round($EmbossingL)?></th>
<th  style="text-align: center ;color: #00cc00"><?php echo round($StitchingL)?></th>
<th  style="text-align: center ;color: #ff3333"><?php echo round($PrintingR)?></th>
<th  style="text-align: center ;color: #ff3333"><?php echo round($DyingR)?></th>
<th  style="text-align: center ;color: #ff3333"><?php echo round($EmbossingR)?></th>
<th  style="text-align: center ;color: #ff3333"><?php echo round($StitchingR)?></th>
</tr>
<?php } 
$selectTotal="SELECT        SUM(dbo.tbl_Pro_DailyPRD.Pass) AS Pass, SUM(dbo.tbl_Pro_DailyPRD.PrintingL) AS PrintingL, SUM(dbo.tbl_Pro_DailyPRD.PrintingR) AS PrintingR, 
                         SUM(dbo.tbl_Pro_DailyPRD.StitchingR) AS StitchingR, SUM(dbo.tbl_Pro_DailyPRD.StitchingL) AS StitchingL, SUM(dbo.tbl_Pro_DailyPRD.EmbossingR) 
                         AS EmbossingR, SUM(dbo.tbl_Pro_DailyPRD.EmbossingL) AS EmbossingL, SUM(dbo.tbl_Pro_DailyPRD.DyingR) AS DyingR, SUM(dbo.tbl_Pro_DailyPRD.DyingL) 
                         AS DyingL, SUM(dbo.tbl_Pro_DailyPRD.PassRight) AS PassRight
FROM            dbo.tbl_Pro_DailyPRD INNER JOIN
                         dbo.tbl_Pro_Process_Defect ON dbo.tbl_Pro_DailyPRD.DefectID = dbo.tbl_Pro_Process_Defect.DefectID INNER JOIN
                         dbo.tbl_Pro_Processes ON dbo.tbl_Pro_Process_Defect.ProcessID = dbo.tbl_Pro_Processes.ProcessID INNER JOIN
                         dbo.tbl_Inv_Tran_Date ON dbo.tbl_Pro_DailyPRD.DayID = dbo.tbl_Inv_Tran_Date.DayNo
WHERE        (dbo.tbl_Inv_Tran_Date.DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))"; 
$resultT=sqlsrv_query($conn,$selectTotal);     
$rowT = sqlsrv_fetch_array($resultT);
$PrintingLT=$rowT['PrintingL'];
$StitchingLT=$rowT['StitchingL'];
$EmbossingLT=$rowT['EmbossingL']; 
$DyingLT=$rowT['DyingL']; 
$PrintingRT=$rowT['PrintingR'];
$StitchingRT=$rowT['StitchingR'];
$EmbossingRT=$rowT['EmbossingR']; 
$DyingRT=$rowT['DyingR']; 
?>
<tr style="background-color:#282828; color:#fff; font-size: 18px;">
<td>Total:</td>
<td style="text-align: center"><?php echo round($PrintingLT)?></td>
<td style="text-align: center"><?php echo round($DyingLT)?></td>
<td style="text-align: center"><?php echo round($EmbossingLT)?></td>
<td style="text-align: center"><?php echo round($StitchingLT)?></td>
<td style="text-align: center"><?php echo round($PrintingRT)?></td>
<td style="text-align: center"><?php echo round($DyingRT)?></td>
<td style="text-align: center"><?php echo round($EmbossingRT)?></td>
<td style="text-align: center"><?php echo round($StitchingRT)?></td>
</tr>
</tbody>
</table>
</div>
<!-- <div class="col-md-6">
<div id="container" style="height: 350px; "></div>
</div><div class="col-md-6">
<div id="containerthree" style="height: 350px; "></div> -->
<script src="./js/Canvas.js"></script>
</div>   
<?php
include_once("./Footer/footer.php");
}
}else{
header("location:./index.php");
}
?>