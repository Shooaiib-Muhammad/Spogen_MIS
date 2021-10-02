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
$select="SELECT        leftFail, leftPass, DateName, leftPass + leftFail AS TotalChecked
FROM            dbo.View_left_Prd
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
$row = sqlsrv_fetch_array($result);
$leftFail=$row['leftFail'];
 $leftPass=$row['leftPass'];
$TotalChecked=$row['TotalChecked']; 
if($TotalChecked==0){
  $RftData=0;
}else{
  $RftData=$leftPass/$TotalChecked;
}
$Rft=$RftData*100;
$select1="SELECT        RightFail, RightPass, DateName
FROM            dbo.View_Right_Prd
WHERE        (DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ;
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
$Production= $leftPass+ $RightPass1;
$RFTSum=$Rft+$Rft1;
$RFTAvg=$RFTSum/2;
$Checked=min($TotalChecked,$TotalChecked1);
$Total_Pass=min($leftPass,$RightPass1);
$Total_Fail=min($leftFail,$RightFail1);
$Total_RFT=min($Rft,$Rft1);






?>
<script src="./js/Jquery1.js"></script>
<!-- <script type="text/javascript">
     function Myfunction(){
    var Domain=$("#Data").val();
    $.post("DashboardDate.php",{Date: Domain},function(data, status){
       $("#Tabel").html(data);
   });
    }
</script> -->
<script type="text/javascript">
var  chart =  new  CanvasJS.Chart("container", {
  animationEnabled: true,
  backgroundColor: "white",
  theme: "light1",
   // "light1", "light2", "dark1", "dark2"
  title:{
    text: " Gloves Production <?php echo Round($Total_Pass); ?>",
  },
  data: [{
    type: "column", //change type to bar, line, area, pie, etc
    //indexLabel: "{y}", //Shows y value on all Data Points
    indexLabelFontColor: "#5A5757",
    indexLabelPlacement: "outside",   
   // , , , , , ,, , "", "", "", "", "", "", "", "", "", "", "", "", "#AAAAAA"
     dataPoints: [
     { label:"Total Inspected", y: <?php echo  round($Checked); ?>,color: "#3399ff", },
     { label:"Total Accepted", y: <?php echo  round($Total_Pass); ?>, color: " #99ff33"},
     { label:"Total Rejected", y: <?php echo  round($Total_Fail); ?>, color: " #ff3333"}
  ],
   indexLabelFontSize: 20,
   indexLabel: "{y}"
  }]
});
chart.render();
var  chart =  new  CanvasJS.Chart("containerthree", {
  animationEnabled: true,
  backgroundColor: "white",
  theme: "light1",
   // "light1", "light2", "dark1", "dark2"
  
  title:{
  text: "Gloves RFT  (<?php echo Round($Total_RFT);?> %)"
  },
  data: [{
    type: "column", //change type to bar, line, area, pie, etc
    //indexLabel: "{y}", //Shows y value on all Data Points
    indexLabelFontColor: "#5A5757",
    indexLabelPlacement: "outside",   
   // , , , , , ,, , "", "", "", "", "", "", "", "", "", "", "", "", "#AAAAAA"
     dataPoints: [
    { label:"RFT", y: <?php echo  round($Total_RFT); ?>,color: "#ff9900" }
  ],
   indexLabelFontSize: 20,
   indexLabel: "{y}%"
  }]
});
chart.render();
</script>
<div id="Tabel">
<div class="col-md-4"></div>
<div class="col-md-4">
<table class="table table-hover " style="border: 1px white solid; width:100%; ">
<thead style=" background: #282828; color: white; font-size: 20px; "  >
<th style="text-align: center;"><?php echo $Date;?> Production</th>
</thead>
</table>
</div><div class="col-md-4"></div>
<div class="col-md-6">
<div id="container" style="height: 350px; "></div>
</div><div class="col-md-6">
<div id="containerthree" style="height: 350px; "></div>
</div>


<?php } ?>