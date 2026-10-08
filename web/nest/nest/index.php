<?php
session_start();
?>
<html>
<head>
	<meta http-equiv="refresh" content="60;." />
	<title>"<?php echo php_uname('n'); ?>" - NEST</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<style type="text/css">
		a{font-size:12px;text-decoration:none;}
		a:link{color:#777;}
		a:visited{color:#777;}
		a:hover{text-decoration:underline;}
		#ket{font-size:11px;}
		td{font-size:12px;}
		#entity{padding:5px;}
	</style>
	<script src="facebox/jquery.js" type="text/javascript"></script>
	<link href="facebox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="facebox/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('a[rel*=facebox]').facebox({
				loading_image:'facebox/loading.gif',
				close_image:'facebox/closelabel.gif'
			})
		});
		function popup(){
			window.open("chart_view.php","mywindow","width=700,height=400");
		}
	</script>
</head>
<body style="background: url(image/background.jpg) repeat-x;">
<?php

if(isset($_SESSION["netadmin"])){

include "mysql_connect.php";

$sqlrecent="select received_at as \"Time\",program as \"Log Source\",host as \"Src Host\",NULL as \"Dst Host\",signature as \"Context\",filepath as \"Evidence\" from spiEDR UNION select received_at as \"Time\", program as \"Log Source\", host as \"Src Host\", hostname as \"Dst Host\",type as \"Context\",request as \"Evidence\" from bunnywaf UNION select received_at as \"Time\",program as \"Log Source\",host as \"Src Host\",NULL as \"Dst Host\",signature as \"Context\",file as \"Evidence\" from delpy UNION select received_at as \"Time\",program as \"Log Source\",src_ip as \"Src Host\",dest_ip as \"Dst Host\",signature as \"Context\",http_url as \"Evidence\" from suricata UNION select received_at as \"Time\",program as \"Log Source\",client as \"Src Host\",NULL as \"Dst Host\",category as \"Context\", url as \"Evidence\" from cumi UNION select received_at as \"Time\", program as \"Log Source\", srcip as \"Src Host\",NULL as \"Dst Host\", event as \"Context\", user as \"Evidence\" from sentraID ORDER BY Time DESC LIMIT 20;";
$qryrecent=mysql_query($sqlrecent);
$totalrecent=mysql_num_rows($qryrecent);

$sqlmalicious="SELECT
    `Src Host`,
    COUNT(*) AS `Count`
FROM (
    SELECT host AS `Src Host`
    FROM spiEDR

    UNION 

    SELECT host AS `Src Host`
    FROM bunnywaf

    UNION 

    SELECT host AS `Src Host`
    FROM delpy

    UNION

    SELECT src_ip AS `Src Host`
    FROM suricata

    UNION

    SELECT client AS `Src Host`
    FROM cumi

    UNION

    SELECT srcip AS `Src Host`
    FROM sentraID
) AS combined
WHERE `Src Host` IS NOT NULL
GROUP BY `Src Host`
ORDER BY `Count` DESC
LIMIT 20;";
$qrymalicious=mysql_query($sqlmalicious);
$totalmal=mysql_num_rows($qrymalicious);

?>
<table align="center" style="border:outset;width:1156px;">
	<tr>
		<td bgcolor="#ffffff" valign="top" style="padding:10px;">
		<div align="center" style="margin-bottom:10px;">
			<div align="right" valign="top">
				<img src="image/logout.png" /><a href="logout" style="color:#999999;">LOGOUT</a>
				&nbsp;&nbsp;&nbsp;
				<img src="image/account.png" /><a href="account" rel="facebox">ACCOUNT</a>				
				&nbsp;&nbsp;&nbsp;
				<img src="image/about.png" /><a href="about" rel="facebox">ABOUT</a>
			</div>
			<div align="center" style="font-size:25px;">
			<img src="image/nest.jpg" /><br/>NEST - Integrated Alerting System
			</div>
		</div><hr/>
		<table style="border:0px;width:1148px;"><tr>
		<td valign="top">
		<div id="entity">
		<big><strong>Most recent alert</strong></big> <a href="."><img src="image/refresh.png" /></a><br>
		<div id="ket">Host reported doing malicious activity recently</div>
		<table style="border:solid 1px;width:1000px;"><tr style="background-color:#aaaaaa;"><th>Time</th><th>Log Source</th><th>Src Host</th><th>Dst Host</th></th><th>Context</th><th>Evidence</th></tr>
		<?php
		if($totalrecent==0){
			echo "<tr style=\"background-color:#e5e5e5;\"><td colspan=\"5\"><font style=\"font-size:11px;color:#ff0000;\">Horray, no intruders detected!</td></tr>";
		}
		else{
			while($rowrecent=mysql_fetch_array($qryrecent)){
				echo "<tr style=\"background-color:#e5e5e5;\"><td align=\"leftt\">".$rowrecent['Time']."</td><td>".$rowrecent['Log Source']."</td><td align=\"left\">".$rowrecent['Src Host']."</td><td align=\"left\">".$rowrecent['Dst Host']."</td><td align=\"left\">".$rowrecent['Context']."</td><td align=\"left\">".$rowrecent['Evidence']."</td></tr>";
			}
		}
		?>
		</table>
		<br/>
		</div>
		</td>		
		<td valign="top">
		<div id="entity">
		<big><strong>Top host</strong></big>
		<div id="ket">Most recorded hosts</div>
		<table style="border:solid 1px;width:148px;"><tr style="background-color:#aaaaaa;"><th>Src Host</th><th>Hit</th></tr>
		<?php
		if($totalmal==0){
			echo "<tr style=\"background-color:#e5e5e5;\"><td colspan=\"5\"><font style=\"font-size:11px;color:#ff0000;\">Horray, no intruders detected!</td></tr>";
		}
		else{
			while($rowmalicious=mysql_fetch_array($qrymalicious)){
				echo "<tr style=\"background-color:#FFDFD9;\"><td><a href=\"detail/?host=".$rowmalicious['Src Host']."\" rel=\"facebox\">".$rowmalicious['Src Host']."</a></td><td align=\"center\"><a href=\"detection?host=".$rowmalicious['Src Host']."\" rel=\"facebox\">".$rowmalicious['Count']."</a></td></tr>";
			}
		}
		?>
		</td></tr></table>
		<br/>
		</div>
		</table>
                <div style="padding:10px;color:#999;">
		<img src="image/running.gif" /> sentraID - Identity Security (ITDR)<br>
                <img src="image/running.gif" /> spiEDR - Endpoint Security (EDR)<br>
                <img src="image/running.gif" /> suricata - Network Security (NIDS)<br>
                <img src="image/running.gif" /> bunnywaf - Web App Security (WAF)<br>
		<img src="image/running.gif" /> cumi - Web Access Security (SWG)<br>
                <img src="image/running.gif" /> delpy - Data Security (DLP)<br>
                </div>
		</td>
	</tr>
</table>
<?php
}
else{
?>
<center>
<div style="margin-top:100px;">
	<form method="post" action="login/" style="background-color:#ffffff;width:300px;padding:10px;border:outset;">
	<img src="image/nest.jpg" /><br>NEST - Integrated Alerting System<br><hr><br>
		USERNAME&nbsp;&nbsp;<input type="text" name="username"><br><br>
		PASSWORD&nbsp;&nbsp;<input type="password" name="password"><br><br>
		<input type="submit" value="L O G I N">
	</form>
</div>
</center>
<?php
}
?>
<center>
<font size="2">NEST v0.0.1 <em>coffee-left</em> 2010 Ade Ismail Isnan<br></font>
</center>
</body>
</html>
