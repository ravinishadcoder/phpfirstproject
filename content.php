<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(isset($_GET["subj"])){
	$sel_subj=$_GET["subj"];
    $sel_page="";
}elseif(isset($_GET["page"])){
	$sel_page=$_GET["page"];
	$sel_subj="";
}else{
	$sel_page="";
	$sel_subj="";
}
?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<ul class="subjects">
		<?php
	  $subject_result=get_all_subjects();
		if ($subject_result->num_rows > 0) {
			// output data of each row
			while($subject = $subject_result->fetch_assoc()) {
			  echo "<li><a href=\"content.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>"  ;
			  echo "<ul class=\"pages\">";
			  
			$result=get_pages_for_subject($subject["id"]);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			  echo "<li>
			  <a href=\"content.php?page=".urlencode($row["id"])."\">
			  {$row["menu_name"]} </a></li>"  ;
			}
			echo"</ul>";
		  }
			}
		  }
		?>
		</ul>
		</td>
		<td id="page">
			<h2>Content Area</h2>
			<?php
			echo $sel_subj;
			?><br>
			<?php
			echo $sel_page;
			?><br>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
