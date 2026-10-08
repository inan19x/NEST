<?php
$host = "localhost";
$username = "root";
$password = "1q2w3e4r5t!2";
$dbname = "NEST";

@mysql_connect($host,$username,$password);

@mysql_query("use $dbname");
?>
