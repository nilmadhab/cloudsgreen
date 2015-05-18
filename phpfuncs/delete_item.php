<?php 
require('../all_fns.php');
$conn=db_connect();
	if(isset($_GET['id'])){
		$item_id = $_GET['id'];
		echo $item_id;
		$sql = "DELETE FROM item WHERE id = '{$item_id}' ";
		if(mysql_query($sql,$conn)){
			mysql_query("DELETE FROM item_hash WHERE item_id = '{$item_id}' ",$conn);
			echo "
				<script>
					alert(\"item deleted sucessfully\");
				</script>
			";
		}
		
	}else{
		echo "
				<script>
					alert(\"item deleted failed\");
				</script>
			";
	}

?>