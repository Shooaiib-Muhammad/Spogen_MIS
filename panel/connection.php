<?php

date_default_timezone_set('Asia/karachi');
//$ServerName="server";
$ServerName="ITS-4\SQL2014";
$ConnectionInfo=array('Database'=>'ERPSPG', "UID"=>"sa", "PWD"=>"Forward@123");
$ConnectionInfo2=array('Database'=>'ERPFG', "UID"=>"sa", "PWD"=>"Forward@123");
$conn=sqlsrv_connect($ServerName,$ConnectionInfo);
if ($conn==true){
	// Echo "Established asas";
	// Die;
}else{
	Echo "Connection is Disable";
	die( print_r( sqlsrv_errors(), true));
}
$conn2=sqlsrv_connect($ServerName,$ConnectionInfo2);
if ($conn2==true){
	// Echo "Established asas";
	// Die;
}else{
	Echo "Connection is Disable";
	die( print_r( sqlsrv_errors(), true));
}
?>