<?php
session_start();
if(isset($_SESSION["netadmin"])){
include "../mysql_connect.php";

$host=$_REQUEST[host];
list($byte1,$byte2,$byte3,$byte4)=explode(".",$host);
if($host!=""){
	if($byte1=="10" OR $byte1=="172" OR $byte1=="192"){
		echo "<div style=\"padding:10px;\">Unable to resolv Hostname and GeoIP.<br>Possibly private IP address <a href=\"http://www.faqs.org/rfcs/rfc1918.html\" target=\"_blank\" >RFC 1918</a>.";
	}
	else{
	echo "<div style=\"padding:10px;\">";
		$country=file_get_contents("https://api.hostip.info/get_html.php?ip=$host");
		if (filter_var($host, FILTER_VALIDATE_IP) !== false) {
			$hostname=gethostbyaddr($host);
			echo "<table><tr><td rowspan=\"2\"><img src=\"https://api.hostip.info/flag.php?ip=$host\" /></td><td style=\"padding-left:10px;\"><font color=\"#0000ff\">$hostname</font></td></tr><tr><td style=\"padding-left:10px;\">$country</td></tr></table>";
		}
		else{
			echo "<div style=\"padding:10px;\">ERROR.<br>Must be a Public IP address.";
		}
	}
	echo "</div>";
}
}
else{
	header("Location:../");
}
?>
