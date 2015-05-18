
<?php
require('../all_fns.php');
$conn=db_connect();

		 		echo "
				<script>
					alert(\"item update started\");
				</script>
			";
				
				 $id = mysql_real_escape_string($_POST['id']);
				 $item_name = mysql_real_escape_string($_POST['item_name']);
				 $item_shortcode = mysql_real_escape_string($_POST['item_shortcode']);
				 $item_cost = mysql_real_escape_string($_POST['item_cost']);
				 $item_quantity = mysql_real_escape_string($_POST['item_quantity']);

		if(is_numeric($item_cost)&&is_numeric($item_quantity)){
				$sql = "UPDATE item SET item_name='{$item_name}' ,  						  item_shortcode='{$item_shortcode}',item_cost='{$item_cost}',item_quantity='{$item_quantity}', comp_id = '{$_POST['comp_id']}'
				WHERE id = '{$id}' " ;

				mysql_query($sql,$conn);
				if (!mysql_query($sql,$conn))
				  {
				  die('Error: ' . mysql_error($conn));
				  }
				echo "record sucessfully updated";
		}
		else{
			echo "Please enter number in item cost and quantity";
		}
	// }
?>
