<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$error=array();
//form validation
if(!isset($_POST["menu_name"])||empty($_POST["menu_name"])){
$error[]="menu_name";
}
if(!isset($_POST["position"])||empty($_POST["position"])){
$error[]="position";
}
if(!empty($error)){
    redirect_to("new_subject.php");
}
?>
<?php
$menu_name=$_POST["menu_name"];
$position=$_POST["position"];
$visible=$_POST["visible"];
?>
<?php
$query= "INSERT INTO subjects(
    menu_name,position,visible
)VALUES(
    '{$menu_name}',{$position},{$visible}
)";
if($conn->query($query)){
header("Location:content.php");
}else{
    echo "<p>subject creation failed</p>" . mysql_error();
}
?>
<?php
	if(isset($conn)){
		$conn->close();
	}
	
?>