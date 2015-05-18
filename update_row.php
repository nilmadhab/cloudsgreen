<?php
session_start();
$_SESSION['comp_id'] = "12345" ;
require('all_fns.php');



if(isset($_SESSION['flash'])){
  echo $_SESSION['flash'];
  unset($_SESSION['flash']);
}

$conn=db_connect();

	if(isset($_GET['id'])){
		
   			 if(isset($_POST['submit'])){
				 echo "<br /> macha diya";
				 $item_name = mysql_real_escape_string($_POST['item_name']);
				 $item_shortcode = mysql_real_escape_string($_POST['item_shortcode']);
				 $item_cost = mysql_real_escape_string($_POST['item_cost']);
				 $item_quantity = mysql_real_escape_string($_POST['item_quantity']);

		if(is_numeric($item_cost)&&is_numeric($item_quantity)){
				$sql = "UPDATE item SET item_name='{$item_name}' , 	  					item_shortcode='{$item_shortcode}',item_cost='{$item_cost}',item_quantity='{$item_quantity}'
				WHERE id = '{$_GET['id']}' " ;
//mysql_query($sql,)
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
    
	
	//deleting the rows in item_hash table and inserting new rows
	
				if(!mysql_query("DELETE FROM item_hash WHERE item_id = '{$_GET['id']}'",$conn)){
					die('Error in item hash: ' . mysql_error($conn));
				}
				
				$item_code = mysql_real_escape_string($_POST['item_hash']);
				#echo "item hash is ".$_POST['item_hash'];
			$myArray = explode(',', $item_code);
			//print_r($myArray);
			foreach ($myArray as $value )
			  {
			  //echo "$value <br>";
			  $sql3="INSERT INTO item_hash (item_id, hash_tags)
			VALUES
			('{$_GET['id']}','{$value}')";
			mysql_query($sql3);
			
			  }
			  
	}//post endss
	}//get end
	?>

<script>

		$(document).ready(function() {
			alert("hello world");

$("#update").on('submit', 'form', function(event) {
      alert('Fired!'); // <<<<<=====
      event.preventDefault();
    });
});

	</script>





        <?php
			if(isset($_GET['id'])){
				
			  $sql = "SELECT * FROM item WHERE id = '{$_GET['id']}'";
				//deleting the item
				echo "<button class=\"btn btn-danger pull-right\" onclick=\"delete_item({$_GET['id']})\">Delete Inventory</button>";
				$result = mysql_query($sql,db_connect());
				
				while($row = mysql_fetch_array($result))
				  {
					  echo "<form id=\"update\" action=\"phpfuncs/item_update.php\" method=\"post\" >";
					  echo "<input type=\"hidden\" name=\"id\" value='{$row['id']}'>";
					  echo "<div class=\"form-group\"> ";
				  echo "  item_name <input type=\"text\"  name =\"item_name\"  value='{$row['item_name']}'>";//'" . $record['title']  . "'
				  	echo "</div >";
					echo "<div class=\"form-group\"> ";
				  //echo "  item_name <input type=\"text\"  name =\"comp_id\"  value='{$row['item_name']}'>";//'" . $record['title']  . "'
				  echo "<select name=\"comp_id\">
				  		<option value = \"0\" >Select a company </option>
				  		<option value = \"1\">Tata motors</option>
						<option value =\"2\">Flipkart</option>
						<option value = \"3\">IBM</option>
				  </select>";
				  	echo "</div >";
				   echo "<div class=\"form-group\"> ";
				  echo "item_shortcode <input type=\"text\" value='{$row['item_shortcode']}' name =\"item_shortcode\" >";
				  	echo "</div >";
				  
				   echo "<div class=\"form-group\"> ";
				  echo "item_cost <input type=\"text\" value='{$row['item_cost']}' name =\"item_cost\" >";
				  	echo "</div >";
				  
				   echo "<div class=\"form-group\"> ";
				  echo " item_quantity <input type=\"text\" value='{$row['item_quantity']}' name =\"item_quantity\" >";
				  	echo "</div >";
					$sql2 = "SELECT * FROM item_hash WHERE item_id = '{$row['id']}' ";
					$result2 = mysql_query($sql2);
					$array = array();
					//print_r($result2);
					while($row2 = mysql_fetch_array($result2)){
						$array[] = $row2['hash_tags'];
						
					}
					$comma_separated = implode(",", $array);
					//echo "<br /> tag to be displayed ".$comma_separated;
					echo "<div class=\"form-group\"> ";
				  echo " item__hash <input type=\"text\" value='{$comma_separated}' name =\"item_hash\" >";
				  	echo "</div >";
				  
				   					 
				  }
			}
			  ?>
              <?php 
			  $array = array('lastname', 'email', 'phone');
$comma_separated = implode(",", $array);
//echo "<hr>{$comma_separated}";
 //echo "<hr />".mysql_real_escape_string("nilmad'' abb ");
			  ?>
              
              <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
<input type="submit" name="submit" onclick="myFunction()" value="Update value" />
    </div>
   
<script>
function myFunction()
{
//alert("Hello World!");
$("#update").submit(function(e) {       
      //alert('Fired!'); // <<<<<=====
	  console.log("ok till now");
      

	// process the form
		$.ajax({
			type 		: 'POST',
			url 		: 'phpfuncs/item_update.php', 
			data: jQuery("#update").serialize(),
			
			 success: function(){ // response is returned by server 
                   
					alert("item is updated sucessfully");
					$("#mytable").load("inventory.php #mytable");
					renew_model();
               },
               error: function(response){
                  // alert(response); // <------ If errors occurs trigger an alert
				  $('#refresh').html("something is wrong");
					
	
	
               },

		})

			e.preventDefault();
		    });
		

		// stop the form from submitting the normal way and refreshing the page

}
function delete_item(x){
	var conf = confirm("Do you Really want to delete the item? ");
	if(conf == false){
			return false;
		//break delete_item(x);  // breaks out of loop completely
	}
	$.ajax({
			type 		: 'POST',
			url 		: 'phpfuncs/delete_item.php?id='+x, // the url where we want to POST
			
			
			 success: function(){ // response is returned by server 

					alert("item is deleted sucessfully");
					$("#mytable").load("inventory.php #mytable");
					
               },
               error: function(response){
                 
				  alert("Sorry item could not be deleted");
					
	
	
               },

		})
		
	
	
}
</script>
  </div>
			  