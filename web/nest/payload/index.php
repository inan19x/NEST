<?php
session_start();
if(isset($_SESSION["netadmin"])){
include "../mysql_connect.php";

$t=$_REQUEST['t'];
$s=$_REQUEST['s'];

if($t!="" && $s!=""){

	echo "<h2>Payload details</h2><hr>";

	$sqlpayload="SELECT * FROM $s WHERE received_at='$t' LIMIT 1";
	$qrypayload=mysql_query($sqlpayload) or die(mysql_error());

	$rowpayload=mysql_fetch_assoc($qrypayload);
	foreach($rowpayload as $field_name => $value){
		echo "<strong>". $field_name . ": </strong>" . $value . "<br>";
	}

}
}
else{
	header("Location:../");	
}
?>
