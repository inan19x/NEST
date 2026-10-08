<?php
session_start();
if(isset($_SESSION["netadmin"])){
include "../mysql_connect.php";

$host=$_REQUEST[host];

if($host!=""){
	$sqllog="SELECT
    `Log Source`,
    `Context`,
    `Time`
FROM (
    SELECT
	received_at AS `Time`,
        program AS `Log Source`,
        host AS `Src Host`,
        signature AS `Context`
    FROM spiEDR

    UNION ALL

    SELECT
	received_at AS `Time`,
        program AS `Log Source`,
        host AS `Src Host`,
        type AS `Context`
    FROM bunnywaf

    UNION ALL

    SELECT
	received_at AS `Time`,
        program AS `Log Source`,
        host AS `Src Host`,
        signature AS `Context`
    FROM delpy

    UNION ALL

    SELECT
	received_at AS `Time`,
        program AS `Log Source`,
        hostname AS `Src Host`,
        signature AS `Context`
    FROM suricata
) AS combined
WHERE `Src Host` = '$host'
ORDER BY `Time` DESC;";
	$qrylog=mysql_query($sqllog);
	echo "<div style=\"color:#f00;font-weight:bold;font-size:20px;width:fit-content;\">Host: $host</div><hr><br>";
	while($rowlog=mysql_fetch_array($qrylog)){
		echo "<strong><big>".$rowlog['Context']."</big></strong><br>detected at ".$rowlog['Time']." by ".$rowlog['Log Source']."<br><br>";
	}
}
}
else{
	header("Location:../");
}
?>
