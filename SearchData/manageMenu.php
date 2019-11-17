<head>
    <title>Cafe</title>
    <!--meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cafe">
	<link href="styleadmin.css" rel="stylesheet"/>
    </head>
	

<nav class="nav">
		<ul>
			<li><a href="manageMenu.php">MANAGE MENU</a></li>
			<!--<li class="dropdown">
				<a href="category.html" class="dropbtn">SALES REPORT</a>
					<div class="dropdown-content">
					</div>
			</li>-->
			
			<li><a href="manageTables.php">MANAGE TABLE</a></li>
			<li><a href="showEmp.php">MANAGE EMPLOYEE</a></li>
			<li><a href="showTxn.php">SEARCH PAYMENT</a></li>
		</ul>
</nav>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu Records</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
</head>
<body>
	<div class="container">
      <div class="">
        <h1>Menu Records</h1>
        <div class="col-sm-8">
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
		<table id="menu_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="foodcode" data-type="numeric" data-identifier="true">Food Code</th>
					<th data-column-id="dishname">Dish Name</th>
					<th data-column-id="description">Category</th>
					<th data-column-id="price">Price</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
	
<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Menu</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="dishname" class="control-label">Dishname:</label>
                    <input type="text" class="form-control" id="dishname" name="dishname"/>
                  </div>
                  <div class="form-group">
                    <label for="description" class="control-label">Category:</label>
                    <input type="text" class="form-control" id="description" name="description"/>
                  </div>
				  <div class="form-group">
                    <label for="price" class="control-label">Price:</label>
                    <input type="text" class="form-control" id="price" name="price"/>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Record</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
				  <div class="form-group">
                    <label for="name" class="control-label">Dish Name:</label>
                    <input type="text" class="form-control" id="edit_dishname" name="edit_dishname"/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">Category:</label>
                    <input type="text" class="form-control" id="edit_description" name="edit_description"/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Price:</label>
                    <input type="text" class="form-control" id="edit_price" name="edit_price"/>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>

<div id="del_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Record</h4>
				<br/>
				<p><strong>Sure to delete this menu?</strong></p>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_del">
				<input type="hidden" value="delete" name="action" id="action">
				<input type="hidden" value="0" name="delete_id" id="delete_id">
				  <div class="form-group">
                    <label for="name" class="control-label">Dish Name:</label>
                    <input type="text" class="form-control" id="del_dishname" name="del_dishname"/>
                  </div>
                  <div class="form-group">
                    <label for="category" class="control-label">Category:</label>
                    <input type="text" class="form-control" id="del_description" name="del_description"/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Price:</label>
                    <input type="text" class="form-control" id="del_price" name="del_price"/>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_del" class="btn btn-primary">Delete</button>
            </div>
			</form>
        </div>
    </div>
</div>

		  
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#menu_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "menuResponse.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();

		$('#edit_model').modal('show');
if($(this).data("row-id") !=0) {
							
                                // collect the data
								$('#edit_id').val(ele.siblings(':first').html()); 
								// in case we're changing the key
                                $('#edit_dishname').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_description').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_price').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_price').val(ele.siblings(':nth-of-type(4)').html());
					} 
    })
 	
 	 grid.find(".command-delete").on("click", function(e)
    {
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
			var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
			
		$('#del_model').modal('show');
if($(this).data("row-id") !=0) {
						 // collect the data
								$('#del_id').val(ele.siblings(':first').html()); 
								// in case we're changing the key
                                $('#del_dishname').val(ele.siblings(':nth-of-type(2)').html());
                                $('#del_description').val(ele.siblings(':nth-of-type(3)').html());
                                $('#del_price').val(ele.siblings(':nth-of-type(4)').html());
					} 
    }) 
	

	
/*.end().find(".command-delete").on("click", function(e)
    {
  
    var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
          alert(conf);
                    if(conf){
                                /*$.post('response.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
                    $("#employee_grid").bootgrid('reload');
                                });  
                //$(this).parent('tr').remove();
                //$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    })*/
	
	
	
	
}); 

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "menuResponse.php",  
				  data: data,
				  dataType: "json",       
				  success: function(menuResponse)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#menu_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
			$( ".command-delete" ).click(function() {
			  $('#del_model').modal('show');
			});
		 	 $( "#btn_del" ).click(function() {
			  ajaxAction('delete');
			});  
});
</script>

