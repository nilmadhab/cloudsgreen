
<?php
session_start();
$_SESSION['comp_id'] = "12345" ;
require('all_fns.php');

do_html_header('Inventory');

if(isset($_SESSION['flash'])){
  echo $_SESSION['flash'];
  unset($_SESSION['flash']);
}
$conn=db_connect();
?>
        <div class="box paint color_0">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i><span>Inventory List</span> 
                <span float="style:right">
                    <a data-toggle="modal" href="#myModal" style="float:right" class="btn btn-primary btn-large">Add New Inventory</a>
                </span>
            </h4>
          </div>
          <!-- End .title -->
          <div class="content">
         <style type="text/css">
            #mytable td {
                text-align:center;
            }
            #mytable th {
                text-align:center;
            }
         </style>
            <table class="table table-striped" id="mytable">
              <thead style='text-align:center;'>
                <tr>
                  <th> Item Name </th>
                  <th> Item Code </th>
                  <th> Item Cost </th>
                  <th> Quantity </th>
                  <th> Edit </th>
                  <th> Distribute </th>
                  <th> Delete </th>
                </tr>
              </thead>
              <tbody style='text-align:center;'>
              <div id="refresh">
              <?php

			  require_once('all_fns.php');
			  $sql = "SELECT * FROM item";
				$global_id=1;
				$result = mysql_query($sql,db_connect());
				
				while($row = mysql_fetch_array($result))
				  {
					  echo "<tr>";
				  echo "<td>".$row['item_name']."</td>";
				  echo "<td>".$row['item_shortcode']."</td>";///update_row.php?id={$row['id']}--replacing the data
				  echo "<td>".$row['item_cost']."</td>";//
				   echo "<td>".$row['item_quantity']."</td>";//<a data-toggle="modal" href="#myModal" style="float:right" class="btn btn-primary btn-large">
				   echo "<td> <button class='btn btn-small edit-inventory'><a 
				   			data-toggle=\"modal\" href=\"#myModal2\" style=\"float:right\" onclick=\"get_id({$row['id']})\"><i class='gicon-edit'></i></a></button> </td>";
					echo "<td> <button class='btn btn-small edit-inventory'>
					<a 	data-toggle=\"modal\" href=\"#myModal3\" style=\"float:right\" onclick=\"distribute_id({$row['id']})\">
					<i class='gicon-edit'></i></button></a> </td>";
					echo "<td> <button class='btn btn-small edit-inventory'><a onclick=\"delete_item({$row['id']})\" ><i class='gicon-edit'></i></a></button> </td>";

				   					  echo "</tr>";
				  }

			  ?>
            
              </div>
              	
              </tbody>
            </table>
          </div>
<div class="span6">
          
              <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Add New Inventory</h3>

    </div>

    <div class="modal-body">
        <button class="btn btn-primary" onclick="$('#add-inventory').trigger('reset')">Clear</button>
        <form id="add-inventory" action="phpfuncs/update_table.php" method="post">
        <div class="modal-content"> 
            
           
            	<p><input type="text" name="item_name" value="" placeholder="Enter Item name" required/></p>
                <p><input type="text" name="item_short_code" value="" placeholder="Enter short code" required/></p>
                <p><input type="number" name="item_cost" value="" id="replyNumber" min="0" step="1" data-bind="value:replyNumber" placeholder="Enter Item cost"required /></p>
                <p><input type="number" name="item_quantity" value="" id="replyNumber" min="0" step="1" data-bind="value:replyNumber"  placeholder="Enter Item Quantity" required /></p>
                <p><input type="text" name="item_tag" value="" placeholder="Enter Item tag" required /></p>
               	<select name="item_type">
                <option value="a">a</option>
                <option value="b"> b</option>
                <option value="c" selected>c</option>
                </select>
                <select name="item_category">
                <option value="high">high</option>
                <option value="medium">medium</option>
                <option value="low" selected>low</option>
                </select>
            	
            
        </div>
    </div>
    

                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal">Close</button>
                  <button id="save" type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
              
              
              
              
<!--              here is the pop up box for updating the data-->
              <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div id="id_of_item"></div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Update Inventory</h3>

    </div>
    
    <div class="modal-body">
        

        <div class="modal-content"> 
            
           
            	
            
        </div>
    </div>
    

                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal">Close</button>
                  <!--<button id="save" type="submit" name="submit" class="btn btn-primary">Save changes</button>-->
                </div>
                </form>
              </div>
              
              <!-- here is modal for transfering item -->
              <script>
			  
			  </script>
              <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div id="id_of_item"></div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Distribution of Items </h3>
        

    </div>
    
    <div class="modal-body">
        

       
        <div class="modal-content"> 
            
           
            	
            
        </div>
    </div>
    

                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal">Close</button>
                 
                </div>
                </form>
              </div>
              
            <!-- End .title -->
            <!-- End .content --> 
          </div>
        </div>
        
        
<script>
//all ajax functions goes here
//ajax function for distribution of items
function distribute_id(x){
		 $.ajax({
		
		type: 'POST', 
		url 		: 'ajax_test.php', // the url where we want to POST
		data: jQuery("#distribute").serialize(),
			success: function() {  
	
				$("#myModal3 .modal-content").load("distribute_form.php?id="+x);
	
				$("#mytable").load("inventory.php #mytable");
				$("#distribute").submit(function(e) {       
					
					  e.preventDefault();
		});
			}
			});
	
}
				
$(document).ready(function() {
    
    $(function renew_model() {
        $('#form').trigger("reset");
    });
    //validate the form
    $(function() {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    });
    // process the form
    $('#add-inventory').submit(function(event) {
              

        $.ajax({
            type: 'POST',
            
            url: 'phpfuncs/update_table.php',

            data: jQuery("#add-inventory").serialize(),

            success: function() { 
                
                $("#mytable").load("inventory.php #mytable");
            },
            error: function(response) {

                $('#refresh').html("something is wrong");
            },
            
        })
       
        event.preventDefault();
    });
});
//delete item

function delete_item(x) {
    var conf = confirm("Do you Really want to delete the item? ");
    if (conf == false) {
        return false;
        
    }
    $.ajax({
        type: 'POST',
        url: 'phpfuncs/delete_item.php?id=' + x,
       
        success: function() { // response is returned by server 
            alert("item is deleted sucessfully");
            $("#mytable").load("inventory.php #mytable");
        },
        error: function(response) {
                        alert("Sorry item could not be deleted");
        },
        
    })
}

//updating the form by ajax

function get_id(x) {

    $.ajax({

        type: 'POST',
        url: '',
        data: {
            id: 5
        },

        success: function() {
            
            $("#myModal2 .modal-content").load("update_row.php?id=" + x);
            
            $("#mytable").load("inventory.php #mytable");
            $("#update").submit(function(e) {

                e.preventDefault();
            });
        }
    });
    $("#ajax").on('submit', 'form', function(event) {
        
        event.preventDefault();
    });
}
</script>