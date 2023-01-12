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
		<br/>
		
		</td>
		<td id="page">
        <h2>Add Subject</h2>
			<form action="create_subject.php" method="post">
				<p>Subject name: 
					<input type="text" name="menu_name" value="" id="menu_name" />
				</p>
				<p>Position: 
					<select name="position">
                        <?php
                        $subject_set=get_all_subjects();
                        $subject_counts=mysqli_num_rows($subject_set);
                        for($count=1;$count<=$subject_counts+1;$count++){
                            echo "<option value=\"{$count}\">{$count}</option>";
                        }
                        ?>
                    
					</select>
				</p>
                
				<p>Visible: 
					<input type="radio" name="visible" value="0" /> No
					&nbsp;
					<input type="radio" name="visible" value="1" /> Yes
				</p>
				<input type="submit" value="Add Subject" />
			</form>
			<br />
			<a href="content.php">Cancel</a>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
