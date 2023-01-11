<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
			  echo "<li>{$subject["menu_name"]}</li>"  ;
			  echo "<ul class=\"pages\">";
			  
			$result=get_pages_for_subject($subject["id"]);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			  echo "<li>{$row["menu_name"]}</li>"  ;
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
			
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
