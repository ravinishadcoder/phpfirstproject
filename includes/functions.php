<?php
function confirm_query($result_set){
    if(!$result_set){
        die("Database query failed: " . mysql_error());
    }
}
function get_all_subjects(){
    global $conn;
    $query= "SELECT * 
	           FROM subjects 
			   ORDER BY position ASC";	
      $subject_sql = $query;
      $subject_result = $conn->query($subject_sql);
	  confirm_query($subject_result) ;
      return $subject_result;
}
function get_pages_for_subject($subject_id){
    global $conn;
    $query="SELECT * 
    FROM pages 
    WHERE subject_id={$subject_id}
    ORDER BY position ASC";

$sql = $query;
$result = $conn->query($sql);
confirm_query($result) ;
return $result;
}
function get_subject_by_id($subject_id){
    global $conn;
    $query= "SELECT * 
	        FROM subjects 
            WHERE id={$subject_id}
            LIMIT 1";	
      $subject_sql = $query;   
      $subject_result = $conn->query($subject_sql);
    //   $result = $con->query($tourquery);  // or mysqli_query($con, $tourquery);
      $tourresult = $subject_result->fetch_array();
      
	  confirm_query($subject_result) ;
      return $tourresult;
}
function get_page_by_id($page_id){
    global $conn;
    $query= "SELECT * 
	        FROM pages 
            WHERE id={$page_id}
            LIMIT 1";	
      $subject_sql = $query;   
      $subject_result = $conn->query($subject_sql);
    //   $result = $con->query($tourquery);  // or mysqli_query($con, $tourquery);
      $tourresult = $subject_result->fetch_array();
      
	  confirm_query($subject_result) ;
      return $tourresult;
}
?>