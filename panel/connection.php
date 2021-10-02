<?php

date_default_timezone_set('Asia/karachi');
$ServerName="server";
$ServerName1="ITS-4\SQL2014";
$ConnectionInfo=array('Database'=>'ERPSPG', "UID"=>"ajax", "PWD"=>"Forward@123");
$ConnectionInfo2=array('Database'=>'ERPFG', "UID"=>"sa", "PWD"=>"Forward@123");
$conn=sqlsrv_connect($ServerName,$ConnectionInfo);
if ($conn==true){
	// Echo "Established asas";
	// Die;
}else{
	Echo "Connection is Disable";
	die( print_r( sqlsrv_errors(), true));
}
$conn2=sqlsrv_connect($ServerName1,$ConnectionInfo2);
if ($conn2==true){
	// Echo "Established asas";
	// Die;
}else{
	Echo "Connection is Disable";
	die( print_r( sqlsrv_errors(), true));
}
?>