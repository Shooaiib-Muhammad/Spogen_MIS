<!doctype html>
<html class="no-js" lang="en">
<head>

    <?php
include_once('./Panel/config.php');
if(isset($_SESSION['UserID'])){
$UserID=$_SESSION['UserID'];
 $Query1="SELECT        TOP (100) PERCENT UserID,FirstName,lastName ,LoginName, Password,Status
FROM            dbo.tbl_User_Logins
WHERE        (UserID = $UserID)"; 
 $perem=array();
$option=array("scrollable"=> SQLSRV_CURSOR_KEYSET);
$Dooo1 = sqlsrv_query($conn,$Query1,$perem,$option);
$rows=sqlsrv_num_rows($Dooo1);
$Data1=sqlsrv_fetch_array($Dooo1);
$FirstName=$Data1['FirstName']; 
$lastName=$Data1['lastName']; 
$LoginName=$Data1['LoginName']; 
 if ($Data1['Status']==0) {
    $WebStatus=0;
}
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>SpogenMIS</title>
<link rel="icon" href="logo.png" type="image/x-icon"/>
<link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <!-- adminpro icon CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/animate.css">
    <!-- data-table CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="./css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/normalize.css">
    <!-- charts C3 CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/c3.min.css">
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/form/all-type-forms.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="./style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
</head>

<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Header top area start-->
<div class="wrapper-pro">
<div class="left-sidebar-pro">
<nav id="sidebar">
<div class="sidebar-header">
<a href="#"><img src="./img/message/logo.png" alt="" />
</a>
<h3><?php echo $FirstName; ?>  <?php echo $lastName?></h3>
<p>Online</p>
<strong>MIS</strong>
</div>
<div class="left-custom-menu-adp-wrap">
<ul class="nav navbar-nav left-sidebar-menu-pro">
<li class="nav-item">
  <!--   <a href="compose-mail.html" class="dropdown-item">Compose Mail</a> -->
<a href="dashboard.php" >
<i class="fa big-icon fa-home"></i>
<span class="mini-dn">Home</span>
<span class="indicator-right-menu mini-dn">
</span></a>
</li>
<li class="nav-item">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
<i class="fa big-icon fa-bar-chart-o"></i>
<span class="mini-dn">Production</span> 
<span class="indicator-right-menu mini-dn">
<i class="fa indicator-mn fa-angle-left"></i>
</span></a>
<div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
<a href="ProductionG.php" class="dropdown-item">Gloves</a>
<!-- <a href="ProductionBag.php" class="dropdown-item">Bags</a> -->
<a href="POWiseprdReports.php" class="dropdown-item"> Reports</a>
<a href="POWise.php" class="dropdown-item"> Summary</a>
</div>
</li>

<li class="nav-item">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
<i class="fa big-icon fa-exclamation-triangle"></i>
<span class="mini-dn">Quality Check</span> 
<span class="indicator-right-menu mini-dn">
<i class="fa indicator-mn fa-angle-left"></i>
</span></a>
<div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
<a href="QCSummary.php" class="dropdown-item">Gloves Summary</a>
<!-- <a href="QCSummaryBag.php" class="dropdown-item">Bag Summary</a> -->
<a href="PoWiseReport.php" class="dropdown-item"> Reports </a>
<!-- <a href="#" class="dropdown-item">Football</a> -->
</div>
</li>
<!-- <li class="nav-item">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
<i class="fa big-icon fa-bar-chart-o"></i>
<span class="mini-dn">Charts</span> 
<span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
<div role="menu" class="dropdown-menu left-menu-dropdown chart-left-menu-std animated flipInX">
<a href="bar-charts.html" class="dropdown-item">Bar Charts</a>
<a href="line-charts.html" class="dropdown-item">Line Charts</a>
<a href="area-charts.html" class="dropdown-item">Area Charts</a>
<a href="rounded-chart.html" class="dropdown-item">Rounded Charts</a>
<a href="c3.html" class="dropdown-item">C3 Charts</a>
<a href="sparkline.html" class="dropdown-item">Sparkline Charts</a>
<a href="peity.html" class="dropdown-item">Peity Charts</a>
</div>
</li> -->
<!-- <li class="nav-item">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
<i class="fa big-icon fa-table"></i>
<span class="mini-dn">Data Tables</span> 
<span class="indicator-right-menu mini-dn">
<i class="fa indicator-mn fa-angle-left"></i>
</span></a>
<div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
<a href="static-table.html" class="dropdown-item">Static Table</a>
<a href="data-table.html" class="dropdown-item">Data Table</a>
</div>
</li> -->
</ul>
</div>
</nav>
</div>
<div class="mobile-menu-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="mobile-menu">
<nav id="dropdown">
<ul class="mobile-menu-nav">
<li><a data-toggle="collapse" data-target="#Charts" href="dashboard.php">Home </a>
<ul class="collapse dropdown-header-top">
</ul>
</li>
<li><a data-toggle="collapse" data-target="#demo" href="#">Production <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
<ul id="demo" class="collapse dropdown-header-top">
<li><a href="ProductionG.php">Gloves</a>
</li>
<li><a href="ProductionBag.php">Bags</a>
</li>
<li><a href="#">Football</a>
</li>
</ul>
</li>
<li><a data-toggle="collapse" data-target="#demo" href="#">Quality Check <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
<ul id="demo" class="collapse dropdown-header-top">
<li><a href="QCSummary.php">Gloves Summary</a>
</li>
<li><a href="QCSummaryBag.php">Bag Summary</a>
</li>
<li><a href="#">Detail</a>
</li>
</ul>
</li>
<!-- <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Charts <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
<ul id="Chartsmob" class="collapse dropdown-header-top">
<li><a href="bar-charts.html">Bar Charts</a>
</li>
<li><a href="line-charts.html">Line Charts</a>
</li>
<li><a href="area-charts.html">Area Charts</a>
</li>
<li><a href="rounded-chart.html">Rounded Charts</a>
</li>
<li><a href="c3.html">C3 Charts</a>
</li>
 <li><a href="sparkline.html">Sparkline Charts</a>
</li>
<li><a href="peity.html">Peity Charts</a>
</li>
</ul>
</li> -->
</ul>
</nav>
 </div>
</div>
</div>
</div>
</div>  
<div class="content-inner-all">
<div class="header-top-area">
<div class="fixed-header-top">
<div class="container-fluid">
<div class="row">
<div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
<button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
<i class="fa fa-bars"></i>
</button>
<div class="admin-logo logo-wrap-pro">
<a href="#"><img src="img/logo/log.png" alt="" />
</a>
</div>
</div>
<div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
</div>
 <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
 <div class="header-right-info">
<ul class="nav navbar-nav mai-top-nav header-right-menu">
<li class="nav-item">
<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
<span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
<span class="admin-name">MIS Settings</span>
 <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
</a>
<ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
<li><a href="changePassword.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Change Password</a>
</li>
<li><a href="Logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
</li>
</ul>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- <br>
<br>
<br>
<br> -->
<?php }?>
