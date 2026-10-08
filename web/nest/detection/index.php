<?php
session_start();
if(isset($_SESSION["netadmin"])){
include "../mysql_connect.php";

$host=$_REQUEST['host'];

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
    FROM BunnyWAF

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
        src_ip AS `Src Host`,
        signature AS `Context`
    FROM Suricata

    UNION ALL

    SELECT
	received_at AS `Time`,
	program AS `Log Source`,
	client AS `Src Host`,
	category AS `Context`	
    FROM cumi

    UNION ALL

    SELECT
	received_at AS `Time`,
	program AS `Log Source`,
	srcip AS `Src Host`,
	event AS `Context`	
    FROM sentraID
) AS combined
WHERE `Src Host` = '$host'
ORDER BY `Time` DESC;";
	$qrylog=mysql_query($sqllog);
	echo "<div style=\"font-weight:bold;font-size:20px;width:fit-content;\">Host: $host</div><hr><br>";
	while($rowlog=mysql_fetch_array($qrylog)){
		echo "<strong><big>".$rowlog['Context']."</big></strong><br>detected at ".$rowlog['Time']." by ".$rowlog['Log Source']."<br><br>";
	}
}
}
else{
	header("Location:../");
}
?>
