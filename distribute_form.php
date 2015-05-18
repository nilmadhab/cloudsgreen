 <?php 
 require('all_fns.php');
$conn=db_connect();
 	if(isset($_GET['id'])){
		$item_id = $_GET['id'];
	}
	$sql = "SELECT * FROM item WHERE id = '{$item_id}' ";// AND comp_id = '{$transfer_to_company_id}'";
$query = mysql_query($sql,$conn);
if($query){
	$row = mysql_fetch_assoc($query);
	$item_name = $row['item_name'];
}
 ?>
 
 <form id="distribute" action="ajax_test.php" method="post">
        	<p><b>Item Name : </b><?php echo $item_name;?> <input type="hidden" name="item_id" value="1"></p>
            
            <p>Quantity <input type="number" name="quantity" value=""></p>
            				Transfer_to_company_id <select name="transfer_to_company_id">
				  		<option value = "0" >Select a company </option>
				  		<option value = "1">Tata(1) </option>
						<option value ="2">Flipkart(2)</option>
						<option value ="3">IBM(3)</option>
                        <option value ="4">NVDIA(4)</option>
				  </select>
            <?php echo "<p><input type=\"submit\"  name=\"submit1\" value=\"Send\" onClick=\"distribute({$item_id})\" /></p>"; ?>
        </form>
        
              <script>
			  //ajax function for distribution of items onclick="myFunction()"

			  	function distribute(x){
					//alert("you are inside distribute form");
					$("#distribute").submit(function(e) {       
							 $.ajax({
								
								type: 'POST', 
								url 		: 'ajax_test.php?id='+x, // the url where we want to POST
								data: jQuery("#distribute").serialize(),
									success: function() {  
										alert("item is transferred sucessfully");
										$("#myModal3 .modal-content").load("distribute_form.php?id="+x);
										//$("#myModal2 .modal-content").load("ajax_test.php");
										$("#mytable").load("inventory.php #mytable");
										/*$("#distribute").submit(function(e) {       
											alert('Fired!'); // <<<<<=====
											  e.preventDefault();
											});*/
										}
								});
						  e.preventDefault();
					});
				}
				</script>