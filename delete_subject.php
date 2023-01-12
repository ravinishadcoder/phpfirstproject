<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(intval($_GET['subj'])==0){
    redirect_to("content.php");
}
$id=$_GET["subj"];
if($subject=get_subject_by_id($id)){
$query="DELETE FROM subjects WHERE id={$id}";
$result = $conn->query($query);
redirect_to("content.php");
}else{
    redirect_to("content.php");
}
?>

<?php
	if(isset($conn)){
		$conn->close();
	}
	
?>