<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(isset($_GET["subj"])){
	$sel_subj=$_GET["subj"];
	$sel_subject=get_subject_by_id($sel_subj);
    $sel_page=NULL;
	$sel_pg=0;
}elseif(isset($_GET["page"])){
	$sel_pg=$_GET["page"];
	$sel_subj=0;
	$sel_subject=NULL;
	$sel_page= get_page_by_id($sel_pg);
}else{
	$sel_subj=0;
	$sel_subject=NULL;
	$sel_pg=0;
	$sel_page=NULL;
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
			  {$row["menu_name"]}</a></li>"  ;
			}
			echo"</ul>";
		  }
			}
		  }
		?>
		</ul>
		</td>
		<td id="page">
		<?php if (!is_null($sel_subject)) { // subject selected ?>
			<h2><?php echo $sel_subject['menu_name']; ?></h2>
		<?php } elseif (!is_null($sel_page)) { // page selected ?>
			<h2><?php echo $sel_page['menu_name']; ?>
			<div class="page-content">
				<?php
				echo $sel_page["content"];
				?>
			</div>
		    </h2>
			<div class="page-content">
				<?php echo $sel_page['content']; ?>
			</div>
		<?php } else { // nothing selected ?>
			<h2>Select a subject or page to edit</h2>
		<?php } ?>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
