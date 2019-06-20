<?php
date_default_timezone_set('America/New_York');
error_reporting(0);
$con = mysql_connect("localhost", "root", "");
mysql_select_db("pcon_test", $con);
session_start();
?>