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
<?php
if(intval($_GET["subj"])==0){
redirect_to("content.php");
}

if(isset($_POST["submit"])){
    
    $error=array();
//form validation
$required_field=array("menu_name","position");
foreach($required_field as $fieldname){
    if(!isset($_POST["fieldname"])||empty($_POST["fieldname"])){
        $error[]=$fieldname;
    }
}

if(!empty($error)){
    
    $id=$_GET["subj"];
    $menu_name=$_POST["menu_name"];
    $position=$_POST["position"];
    $visible=$_POST["visible"];
     
    //update
    $query="UPDATE subjects SET
            menu_name='{$menu_name}',
            position={$position},
            visible={$visible}
            WHERE id={$id}";
    $result = $conn->query($query);
    
}
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
			  echo "<li><a href=\"edit_subject.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>"  ;
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
        <h2>Edit Subject:
            <?php echo $sel_subject["menu_name"];?>
        </h2>
			<form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']);?>" method="post">
				<p>Subject name: 
					<input type="text" name="menu_name" value="<?php echo $sel_subject["menu_name"]; ?>" id="menu_name" />
				</p>
				<p>Position: 
					<select name="position">
                        <?php
                        $subject_set=get_all_subjects();
                        $subject_counts=mysqli_num_rows($subject_set);
                        for($count=1;$count<=$subject_counts+1;$count++){
                            echo "<option value=\"{$count}\"";
                            if($sel_subject["position"]==$count){
                                echo " selected";
                            }
                           echo ">{$count}</option>";
                        }
                        ?>
                    
					</select>
				</p>
                
				<p>Visible: 
					<input type="radio" name="visible" value="0"<?php 
                    if($sel_subject["visible"]==0){echo " checked";}
                    ?> /> No
					&nbsp;
					<input type="radio" name="visible" value="1"
                    <?php 
                    if($sel_subject["visible"]==1){echo " checked";}
                    ?>
                     /> Yes
				</p>
				<input type="submit" name="submit" value="Edit Subject" />
			</form>
			<br />
			<a href="content.php">Cancel</a>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>
