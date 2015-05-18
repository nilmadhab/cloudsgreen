<?php
require('all_fns.php');
$sql = "SELECT * FROM item";
				
				$result = mysql_query($sql,db_connect());
				
				while($row = mysql_fetch_array($result))
				  {
					  echo "<tr>";
				  echo "<td>".$row['item_name']."</td>";
				  echo "<td>".$row['item_shortcode']."</td>";
				  echo "<td>".$row['item_cost']."</td>";
				   echo "<td>".$row['item_quantity']."</td>";
				   echo "<td> <button class='btn btn-small edit-inventory'><i class='gicon-edit'></i></button> </td>";
				   					  echo "</tr>";
				  }
			  ?>