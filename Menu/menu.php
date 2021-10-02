




 <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Loading Data...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->

    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                   <li id="hiddee"  style="color: #fff;">
                         <a href="#">
                            <i class="material-icons">dashboard</i>
                            <span>Hide Menu</span>
                       </a>
                    </li>
                      <li id="Showww" style="color: #fff;">
                        <a href="#">
                            <i class="material-icons">dashboard</i>
                           
                         <span>Show Menu</span>
                     </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <?php
if(isset($_SESSION['UserID'])){
     $UserID=$_SESSION['UserID'];
     $Query1="SELECT        TOP (100) PERCENT UserID, LoginName, Password, WebStatus, AmbStatus, TMStatus, MSStatus,AMBQC,TMQC,MS,HSStatus,Insertion,Inspection
FROM            dbo.tbl_User_Logins
WHERE        (UserID = $UserID)";
 $perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);

                $Dooo1 = sqlsrv_query($conn,$Query1,$perem,$option);
  $rows=sqlsrv_num_rows($Dooo1);
  $Data1=sqlsrv_fetch_array($Dooo1);


   if ($Data1['Inspection']==0) {
    $Inspection=0;

    # code...
}else {
    $Inspection=1;
}
  if ($Data1['WebStatus']==0) {
    $WebStatus=0;

    # code...
}else {
    $WebStatus=1;
}
 if ($Data1['Insertion']==0) {
    $Insertion=0;

    # code...
}else {
    $Insertion=1;
}


    if ($Data1['AmbStatus']==0) {
    $AmbStatus=0;

    # code...
}else {
    $AmbStatus=1;
}

 if ($Data1['TMStatus']==0) {
    $TMStatus=0;

    # code...
}else {
    $TMStatus=1;
}

 if ($Data1['MSStatus']==0) {
    $MSStatus=0;

    # code...
}else {
    $MSStatus=1;
}

 $AmbStatus;
if ($Data1['AMBQC']==0) {
    $AMBQC=0;

    # code...
}else {
    $AMBQC=1;
}

 if ($Data1['TMQC']==0) {
    $TMQC=0;

    # code...
}else {
    $TMQC=1;
}
if ($Data1['MS']==0) {
    $MS=0;

    # code...
}else {
    $MS=1;
}
if ($Data1['HSStatus']==0) {
    $HS=0;

    # code...
}else {
    $HS=1;
}


?>
<section >
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar" style="margin-top: -20px;">
            <!-- User Info -->
           <div class="user-info" style="color: #fff;">
            
                   
                             <div class="image">
                    <img src="../Css/fwrdlogo.png" width="48" height="48" alt="User" />
                </div>
                            <span style="font-weight: bold;"><?php
                            if(isset($_SESSION['UserName'])){

Echo $_SESSION['UserName'];
                              }  ?></span>
                       
                        
                        <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Forward Sports</div>
                    
                    <div class="btn-group user-helper-dropdown" >
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right" style="width: 50px;">
                           
                            <li><a href="chngpwd.php">Change Password</a></li>
                            <li><a href="Logout.php">LogOut</a></li>
                        </ul>
                    </div>
                </div>
                  
            </div> 
           
        
            <?php

if(isset($_SESSION['UserName'])){
$Name=$_SESSION['UserName'];
            ?>
            <div class="menu">
                <ul class="list">
                  
               
                    <li >
                        <a href="../Admin/Admin.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
              
                    <li class="Active">
                        <a href="../Admin/Dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                     <li >
                        <a href="../Admin/Prd.php">
                            <i class="material-icons">business</i>
                            <span>Production Orders</span>
                        </a>
                    </li>
                    
             <?php       if($Insertion==1){
?>

                        <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_circle</i>
                            <span>Data Insertion</span>
                        </a>
                        <ul class="ml-menu">
                           
                            <li >
                                    <a href="../Admin/DE.php" style=" "><i class="far fa-chart-bar"></i> Add SAM Value</a>
                                </li>
                                <li >
                                    <a href="../Hours/Forming.php" style=" "><i class="far fa-chart-bar"></i> AMB Forming</a>
                                </li>
                              </ul>
                    </li>
                    <?php

}

                



if($Name=="Admin" or $Name=="waqas" or  $Name=="Jamshaid") { ?>
                      <li>
                        <a href="../Admin/Usermanual.php">
                            <i class="material-icons">verified_user</i>
                            <span>User Management</span>
                        </a>
                    </li>
                <?php


            }
if($AmbStatus==1){
?>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">insert_chart</i>
                            <span>AMB</span>
                        </a>
                        <ul class="ml-menu">
                           
                            <li >
                                    <a href="AMB.php" style=" "><i class="far fa-chart-bar"></i> All</a>
                                </li>
                              
                                <li>
                                    <a href="AMB1.php"><i class="far fa-chart-bar"></i> Line No 1</a>
                                </li>
                                <li>
                                    <a href="AMB2.php"><i class="far fa-chart-bar"></i> Line No 2</a>
                                </li>
                                <li>
                                    <a href="AMB3.php"> <i class="far fa-chart-bar"></i> Line No 3</a>
                                </li>
                                <li>
                                    <a href="AMB4.php"><i class="far fa-chart-bar"></i> Line No 4</a>
                                </li>
                                <li>
                                    <a href="AMB5.php"><i class="far fa-chart-bar"></i> Line No 5</a>
                                </li>
                                <li>
                                    <a href="AMB6.php"><i class="far fa-chart-bar"></i> Line No 6</a>
                                </li>
                                <li>
                                    <a href="AMB7.php"><i class="far fa-chart-bar"></i> Line No 7</a>
                                </li>
                                <li>
                                    <a href="AMB8.php"><i class="far fa-chart-bar"></i> Line No 8</a>
                                </li>
                                <li>
                                    <a href="AMB9.php"><i class="far fa-chart-bar"></i> Line No 9</a>
                                </li>
                                  <li >
                                    <a href="AMBDate.php"><i class="fas fa-calendar-alt"></i> Date Wise </a>
                                </li>
                               
                                  <li >
                                    <a href="AMBSummary.php"><i class="fas fa-calendar-alt"></i> Date Wise Summary</a>
                                </li>
                                 <li>
                                    <a href="AmbDateSummary.php"><i class="fas fa-calendar-alt"></i>  Summary</a>
                                </li>
                        </ul>
                    </li>
                       <?php

                   }
if($AMBQC==1){
                   ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">error</i>
                            <span> AMB QC</span>
                        </a>
                        <ul class="ml-menu">
                        <li >
                                    <a 
                                    href="AMBERROR.php"><i class="fas fa-calendar-alt"></i>   All</a>
                                </li>
                                 <li >
                                    <a href="meErrorSummary.php" ><i class="fas fa-calendar-alt"></i>  Summary</a>
                                </li>
                        </ul>
                    </li>
                       <?php  }


                         if($TMStatus==1){
                         ?>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="material-icons">insert_chart</i>
                            <span>TM</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                    <a href="TM.php"><i class="far fa-chart-bar"></i> All</a>
                                </li>
                                
                               
                                <li>
                                    <a href="F2.php"><i class="far fa-chart-bar"></i> B34002</a>
                                </li>
                               
                               
                                <li> 
                                    <a href="F3.php"><i class="far fa-chart-bar"></i> B34003</a>
                                </li>
                                
                                <li>
                                    <a href="F4.php"><i class="far fa-chart-bar"></i> B34004</a>
                                </li>
                                 <li >
                                    <a href="TMBDate.php"><i class="fas fa-calendar-alt"></i> Date Wise</a>
                                </li>
                                 <li >
                                    <a href="Cutting.php" ><i class="fas fa-calendar-alt"></i> Cutting</a>
                                </li>
                        </ul>
                    </li>
                       <?php

}
if($TMQC==1){
                              ?>
                      <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">error</i>
                            <span> TM QC</span>
                        </a>
                        <ul class="ml-menu">
                        <li >
                                    <a 
                                    href="EB34002.php"><i class="fas fa-calendar-alt"></i>   All</a>
                                </li>
                                <li >
                                    <a href="ErrorSummary.php" ><i class="fas fa-calendar-alt"></i>  Summary</a>
                                </li>
                                
                        </ul>
                    </li>
                     <?php }
                        if($MS==1){
                        ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">insert_chart</i>
                            <span>MS</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                    <a href="MSdata.php"><i class="far fa-chart-bar"></i> All</a>
                                </li>
                              <li >
                                    <a href="MSLine1.php"><i class="far fa-chart-bar"></i> Line 1</a>
                                </li>
                              
                             <li >
                                    <a href="MSLine2.php"><i class="far fa-chart-bar"></i> Line 2</a>
                                </li>
                                     <li >
                                    <a href="MSLine3.php"><i class="far fa-chart-bar"></i> Line 3</a>
                                </li>
                                 <li >
                                    <a href="MSLine4.php"><i class="far fa-chart-bar"></i> Line 4</a>
                                </li>
                                 <li >
                                    <a href="MSLine5.php"><i class="far fa-chart-bar"></i> Line 5</a>
                                </li>
                                 <li >
                                    <a href="MSLine6.php"><i class="far fa-chart-bar"></i> Line 6</a>
                                </li>
                                 <li >
                                    <a href="MSLine7.php"><i class="far fa-chart-bar"></i> Line 7</a>
                                </li> 
                                  <li >
                                    <a href="MSLine8.php"><i class="far fa-chart-bar"></i> Line 8</a>
                                </li> 
                                  <li >
                                    <a href="MSLine9.php"><i class="far fa-chart-bar"></i> Line 9</a>
                                </li> 
                                  <li >
                                    <a href="MSLine10.php"><i class="far fa-chart-bar"></i> Line 10</a>
                                </li> 
                                  <li >
                                    <a href="MSLine11.php"><i class="far fa-chart-bar"></i> Line 11</a>
                                </li> 
                                  <li >
                                    <a href="MSLine12.php"><i class="far fa-chart-bar"></i> Line 12</a>
                                </li> 
                                  <li >
                                    <a href="MSLine13.php"><i class="far fa-chart-bar"></i> Line 13</a>
                                </li> 
                                  <li >
                                    <a href="MSLine14.php"><i class="far fa-chart-bar"></i> Line 14</a>
                                </li> 
                                  <li >
                                    <a href="MSLine15.php"><i class="far fa-chart-bar"></i> Line 15</a>
                                </li> 
                                  <li >
                                    <a href="MSLine16.php"><i class="far fa-chart-bar"></i> Line 16</a>
                                </li> 
                                  <li >
                                    <a href="MSLine17.php"><i class="far fa-chart-bar"></i> Line 17</a>
                                </li> 
                                  <li >
                                    <a href="MSLine18.php"><i class="far fa-chart-bar"></i> Line 18</a>
                                </li> 
                                  <li >
                                    <a href="MSLine19.php"><i class="far fa-chart-bar"></i> Line 19</a>
                                </li> 
                                  <li >
                                    <a href="MSLine20.php"><i class="far fa-chart-bar"></i> Line 20</a>
                                </li> 
                                  <li >
                                    <a href="MSLine21.php"><i class="far fa-chart-bar"></i> Line 21</a>
                                </li> 

  <li >
                                    <a href="MSDataWise.php"><i class="-glyphicon glyphicon-calendar-alt"></i> Date Wise</a>
                                </li> 
                                <li >
                                    <a href="MSDateSummary.php"><i class="-glyphicon glyphicon-calendar-alt"></i> Date Wise Summary</a>
                                </li> 
                        </ul>
                    </li>
                      <?php }
                        if($MSStatus==1){
                        ?>
                            <li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">error</i>
                            <span> MS QC</span>
                        </a>
                        <ul class="ml-menu">
                        <li >
                                    <a 
                                    href="MS__QC_Summary.php"><i class="fas fa-calendar-alt"></i>   All</a>
                                </li>
                                 
                        </ul>
                    </li>
                 <?php }
                         if($Inspection==1){
                       ?>
                       <li >
                        <a href="../Admin/Inspection.php" >
                            <i class="material-icons">assignment_turned_in</i>
                            <span >Inspection</span>
                        </a>
                    </li>
                       <?php   
                     } 
                      
                           if($HS==1){
?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>HS</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                    <a 
                                    href="HSIssuance.php"><i class="fas fa-clipboard-check"></i>  Issuance</a>
                                </li>
                                 <li >
                                    <a href="HSReceiving.php" ><i class="fas fa-cube"></i> Receiving</a>
                                </li>
                                 <li >
                                    <a href="HSpacking.php" ><i class="fas fa-cubes"></i>  Packing</a>
                                </li>
                        </ul>
                    </li>
                    <?php }
                    ?>
                    
                   
                  <li><a href="Logout.php"><i class="material-icons">power_settings_new</i><span>LogOut</span></a></li>
                 
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
         
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        
        <!-- #END# Right Sidebar -->
    </section>
    <?php

}

}

    ?>