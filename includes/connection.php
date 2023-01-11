<?php
require("constants.php");
$conn=mysqli_connect("localhost","root","","widget_corp");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
  }

?>