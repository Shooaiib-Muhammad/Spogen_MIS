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
$select="SELECT        TOP (200) SUM(dbo.Tbl_Daily_Prd.TotalChecked) AS TotalChecked, SUM(dbo.Tbl_Daily_Prd.Pass) AS Pass, SUM(dbo.Tbl_Daily_Prd.Fail) AS Fail
FROM            dbo.Tbl_Daily_Prd INNER JOIN
                         dbo.tbl_Inv_Tran_Date ON dbo.Tbl_Daily_Prd.DayID = dbo.tbl_Inv_Tran_Date.DayNo
WHERE        (dbo.tbl_Inv_Tran_Date.DateName = CONVERT(DATETIME, '$CurrentDate 00:00:00', 102))" ; 
$result=sqlsrv_query($conn,$select);     
$row = sqlsrv_fetch_array($result);
$Total_Fail=$row['Fail'];
 $Total_Pass=$row['Pass'];
$Checked=$row['TotalChecked']; 
if($Checked==0){
  $RftData=0;
}else{
  $Total_RFT=(100/$Checked)*$Total_Pass;
}






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