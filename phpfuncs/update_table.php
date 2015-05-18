<?php
session_start();
$_SESSION['comp_id'] = "12345" ;
require('../all_fns.php');

		if($_POST){
				
			$item_name = mysql_real_escape_string($_POST['item_name']);
		   $item_shortcode = mysql_real_escape_string($_POST['item_shortcode']);
		   $item_cost = mysql_real_escape_string($_POST['item_cost']);
		   $item_quantity = mysql_real_escape_string($_POST['item_quantity']);

		   $item_category = mysql_real_escape_string($_POST['item_category']);
			
			$last_inserted_id = mysql_insert_id();
			$item_id = $last_inserted_id + 1;
			$sql="INSERT INTO item (item_id, comp_id, item_name,item_shortcode,item_cost,item_quantity,item_category)
			VALUES
			('{$item_id}','{$_SESSION['comp_id']}','$_POST[item_name]','$_POST[item_short_code]','$_POST[item_cost]','$_POST[item_quantity]','$_POST[item_category]')";
			

			if (!mysql_query($sql,db_connect()))
			  {
			  die('Error: ' . mysql_error());
			  }
			echo "1 record added";
			$last_inserted_id = mysql_insert_id();
			$item_code = $_POST['item_tag'];
			$myArray = explode(',', $item_code);
			foreach ($myArray as $value )
  {
		  //echo "$value <br>";
		  $sql="INSERT INTO item_hash (item_id, hash_tags)
		VALUES
		('{$last_inserted_id}','{$value}')";
		
		
		if (!mysql_query($sql,db_connect()))
		  {
		  die('Error: ' . mysql_error());
		  }
		echo "1 record added";
		
		  }
			
		}
		else{
			echo "
				<script>
					alert(\"item update failed\");
				</script>
			";
		}
	  
?>

