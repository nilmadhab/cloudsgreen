<?php
	session_start();
	$_SESSION['comp_id'] = "12345" ;
	require('all_fns.php');
	$conn=db_connect();
	
	if(isset($_SESSION['flash'])){
		echo $_SESSION['flash'];
		unset($_SESSION['flash']);
	}

	?>
<?php 
	
	if(isset($_GET['id'])){
		$item_id = $_GET['id'];
	}

	print_r($_POST);
	//$item_id =  $_POST['item_id'];
	$transfer_to_company_id = $_POST['transfer_to_company_id'];
	$quantity = $_POST['quantity'];
	//$transfer_to_company_id = $_GET['transfer_to_company_id'];
	//$quantity = $_GET['quantity'];
	$sql = "SELECT * FROM item WHERE id = '{$item_id}

' ";
// AND comp_id = '{$transfer_to_company_id}'";
$query = mysql_query($sql,$conn);

if($query){
	echo "<br />num of affected rowsa are".mysql_affected_rows();
	//add the quantity into the item
	$row = mysql_fetch_assoc($query);
	print_r($row);
	//if bothe comanies are same then add the items
	
	if($row['comp_id'] == $transfer_to_company_id){
		$quantity +=  $row['item_quantity'];
		mysql_query("UPDATE item SET item_quantity= '{$quantity}'
WHERE id='{$item_id}' ");
} else {
	//subtruct item from main compnay and transefer to other company
	//		mysql_query("");
	$new_quantity =  $row['item_quantity'] - $quantity;
	// new quantity is updated to old company
	mysql_query("UPDATE item SET item_quantity= '{$new_quantity}

'
WHERE id='{$item_id}

' ");
// and rest is tranferred to new company
$sql = "INSERT INTO item (item_id,item_name,comp_id, item_shortcode, item_cost,item_quantity,item_category) 
VALUES ({$row['item_id']}

,'{$row['item_name']}

','{$transfer_to_company_id }

','{$row['item_shortcode']}

',{$row['item_cost']}

,'{$quantity}

','{$row['item_category']}

)') ";

if (!mysql_query($sql))  {
	die('Error: ' . mysql_error($conn));
}

}

}

while($row = mysql_fetch_array($query))  {
	echo $row['item_name'] . " " . $row['item_shortcode'];
	echo "<br>";
}

?>