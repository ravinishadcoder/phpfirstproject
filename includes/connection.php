<?php
require("constants.php");

$connection = mysql_connect("localhost","root","ravi1250");
if (!$connection) {
	die("Database connection failed: " . mysql_error());
}

$db_select = mysql_select_db(DB_NAME,$connection);
if (!$db_select) {
	die("Database selection failed: " . mysql_error());
}
?>