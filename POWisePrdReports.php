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
    <br>
<button type="submit" id="submit" name="submit" class="btn btn-primary " ><i class=" fa fa-search"></i> Search</button></div>
</div>

</form>
<?php

  ?>

<div class="col-md-12" >
<table  class="table table-bordered table-hover" >
<thead style="background-color:  #282828;color:white; height: 10%; border: 4px   #282828 solid;">
<tr style="width: 100%">
<td colspan="9"   style="background-color:#0074D9;text-align: center; color: #fff;"><b>Production (<?php echo $Sdate;?>) To (<?php echo $Edate;?>)</b></td>
</tr>
<tr>
<th  style="text-align: center">Date</th>
<th  style="text-align: center">PONO</th>
<th  style="text-align: center">Article</th>
<th  style="text-align: center">Size</th>
<th  style="text-align: center">Inspected</th>
<th  style="text-align: center">Accepted</th>
<th  style="text-align: center">Rejected</th>
<th  style="text-align: center">RFT</th>
</tr>
</thead>
<?php



   $Query="SELECT        SUM(dbo.Tbl_Daily_Prd.TotalChecked) AS TotalChecked, SUM(dbo.Tbl_Daily_Prd.Pass) AS Pass, SUM(dbo.Tbl_Daily_Prd.Fail) AS Fail, SUM(dbo.Tbl_Daily_Prd.TBackHand) AS TBackHand, 
                         SUM(dbo.Tbl_Daily_Prd.RejBackhandInjection) AS RejBackhandInjection, SUM(dbo.Tbl_Daily_Prd.RejFingerShape) AS RejFingerShape, SUM(dbo.Tbl_Daily_Prd.RejbackEnd) AS RejbackEnd, SUM(dbo.Tbl_Daily_Prd.ROthers) 
                         AS ROthers, SUM(dbo.Tbl_Daily_Prd.RElastic) AS RElastic, SUM(dbo.Tbl_Daily_Prd.RStrap) AS RStrap, SUM(dbo.Tbl_Daily_Prd.RFrontPlam) AS RFrontPlam, SUM(dbo.Tbl_Daily_Prd.AOthers) AS AOthers, 
                         SUM(dbo.Tbl_Daily_Prd.AElastic) AS AElastic, SUM(dbo.Tbl_Daily_Prd.ACuffAberationZone) AS ACuffAberationZone, SUM(dbo.Tbl_Daily_Prd.AStrap) AS AStrap, SUM(dbo.Tbl_Daily_Prd.ACuff) AS ACuff, 
                         SUM(dbo.Tbl_Daily_Prd.AFrontPlam) AS AFrontPlam, SUM(dbo.Tbl_Daily_Prd.Abodypatch) AS Abodypatch, SUM(dbo.Tbl_Daily_Prd.AGuessts) AS AGuessts, SUM(dbo.Tbl_Daily_Prd.ABackEnd) AS ABackEnd, 
                         dbo.tbl_Inv_Tran_Date.DateName, dbo.tbl_Pro_PO_H.POCode, dbo.tbl_Pro_Article.ArtCode, dbo.tbl_Pro_Article_D.ArtSize, CONVERT(Varchar, dbo.tbl_Inv_Tran_Date.DateName, 103) AS DateName1
FROM            dbo.tbl_Pro_PO INNER JOIN
                         dbo.tbl_Pro_PO_D ON dbo.tbl_Pro_PO.PO = dbo.tbl_Pro_PO_D.PO AND dbo.tbl_Pro_PO.POM = dbo.tbl_Pro_PO_D.POM AND dbo.tbl_Pro_PO.ClientID = dbo.tbl_Pro_PO_D.ClientID AND 
                         dbo.tbl_Pro_PO.ArtID = dbo.tbl_Pro_PO_D.ArtID INNER JOIN
                         dbo.tbl_Pro_PO_H ON dbo.tbl_Pro_PO.PO = dbo.tbl_Pro_PO_H.PO INNER JOIN
                         dbo.tbl_Pro_Article ON dbo.tbl_Pro_PO.ClientID = dbo.tbl_Pro_Article.ClientID AND dbo.tbl_Pro_PO.ArtID = dbo.tbl_Pro_Article.ArtID INNER JOIN
                         dbo.tbl_Pro_Article_D ON dbo.tbl_Pro_PO_D.ClientID = dbo.tbl_Pro_Article_D.ClientID AND dbo.tbl_Pro_PO_D.ArtID = dbo.tbl_Pro_Article_D.ArtID AND dbo.tbl_Pro_PO_D.ArtSizeId = dbo.tbl_Pro_Article_D.ArtSizeId AND 
                         dbo.tbl_Pro_Article.ClientID = dbo.tbl_Pro_Article_D.ClientID AND dbo.tbl_Pro_Article.ArtID = dbo.tbl_Pro_Article_D.ArtID INNER JOIN
                         dbo.Tbl_Daily_Prd INNER JOIN
                         dbo.tbl_Inv_Tran_Date ON dbo.Tbl_Daily_Prd.DayID = dbo.tbl_Inv_Tran_Date.DayNo ON dbo.tbl_Pro_PO_D.PO = dbo.Tbl_Daily_Prd.POH AND dbo.tbl_Pro_PO_D.POM = dbo.Tbl_Daily_Prd.POM AND 
                         dbo.tbl_Pro_PO_D.POD = dbo.Tbl_Daily_Prd.POD
GROUP BY dbo.tbl_Pro_PO_H.POCode, dbo.tbl_Pro_Article.ArtCode, dbo.tbl_Pro_Article_D.ArtSize, dbo.tbl_Inv_Tran_Date.DateName, CONVERT(Varchar, dbo.tbl_Inv_Tran_Date.DateName, 103)
HAVING        (dbo.tbl_Inv_Tran_Date.DateName BETWEEN CONVERT(DATETIME, '$StartDateeee 00:00:00', 102) AND CONVERT(DATETIME, '$EndDateeee 00:00:00', 102))";


 $perem=array();
 $option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
 $Doo1 = sqlsrv_query($conn,$Query,$perem,$option);
 $InsQty1=0;
$PackQty1=0;
$DefQty1=0;
While($Data=sqlsrv_fetch_Array($Doo1)){
//print_r($Data);
$ArtCode=$Data['ArtCode'];
$Size=$Data['ArtSize'];
$PONumber=$Data['POCode'];

$InsQty=$Data['TotalChecked'];
$PackQty=$Data['Pass'];
$DefQty=$Data['Fail'];
if($InsQty==0 or $PackQty==0){
  $RFT=0;
}else{
  $RFT=($PackQty/$InsQty)*100;
}
$Date=$Data['DateName1'];

 $InsQty1=$InsQty1+$InsQty;
$PackQty1=$PackQty1+$PackQty;
$DefQty1=$DefQty1+$DefQty;
if($InsQty1==0 or $PackQty1==0){
  $RFT1=0;
}else{
  $RFT1=($PackQty1/$InsQty1)*100;
}
?>
<tbody>
<tr>
<th><?php echo $Date; ?></th>
<th><?php echo $PONumber; ?></th>
<th  style="text-align: center ;" ><?php echo $ArtCode; ?></th>
<th  style="text-align: center ;" ><?php echo $Size; ?></th>
<th  style="text-align: center ;color: blue" ><?php echo round($InsQty)?></th>
<th  style="text-align: center ;color: #00cc00" ><?php echo round($PackQty)?></th>
<th  style="text-align: center ;color: #ff3333" ><?php echo round($DefQty)?></th>
<th  style="text-align: center;color: orange"><?php echo round($RFT,2)?>%</th>

</tr>
<?php }
?>
<tr  style="background-color:black;text-align: center; color: #fff;">
<th colspan="4">Total :</th>

<th  style="text-align: center ;" ><?php echo round($InsQty1)?></th>
<th  style="text-align: center ;" ><?php echo round($PackQty1)?></th>
<th  style="text-align: center ;" ><?php echo round($DefQty1)?></th>
<th  style="text-align: center;"><?php echo round($RFT1,2)?>%</th>

</tr>
</tbody>
</table>
</div>





<?php

    
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