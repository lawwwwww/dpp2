<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Records</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
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
<body>
	<div class="container">
      <div class="">
        <h1>Employee Records</h1>
        <div class="col-sm-8">
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
		<table id="emp_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="empid" data-type="numeric" data-identifier="true">Employee ID</th>
					<th data-column-id="name">Name</th>
					<th data-column-id="address">Address</th>
					<th data-column-id="contactinfo">Contact</th>
					<th data-column-id="role">Role</th>
					<th data-column-id="gender">Gender</th>
					<th data-column-id="email">Email</th>
					<th data-column-id="password">Password</th>
					<th data-column-id="hiredate">Hire Date</th>
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
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                  </div>
                  <div class="form-group">
                    <label for="address" class="control-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address"/>
                  </div>
				  <div class="form-group">
                    <label for="contactinfo" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="contactinfo" name="contactinfo"/>
                  </div>
				  <div class="form-group">
                    <label for="role" class="control-label">Role:</label>
                    <input type="text" class="form-control" id="role" name="role"/>
                  </div>
				  <div class="form-group">
                    <label for="gender" class="control-label">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender"/>
                  </div>
				  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"/>
                  </div>
				  <div class="form-group">
                    <label for="password" class="control-label">Password:</label>
                    <input type="text" class="form-control" id="password" name="password"/>
                  </div>
				  <div class="form-group">
                    <label for="hiredate" class="control-label">Hire Date:</label>
                    <input type="text" class="form-control" id="hiredate" name="hiredate"/>
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
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="name"/>
                  </div>
                  <div class="form-group">
                    <label for="address" class="control-label">Address:</label>
                    <input type="text" class="form-control" id="edit_address" name="address"/>
                  </div>
				  <div class="form-group">
                    <label for="contact" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="edit_contact" name="contact"/>
                  </div>
				  <div class="form-group">
                    <label for="role" class="control-label">Role:</label>
                    <input type="text" class="form-control" id="edit_role" name="role"/>
                  </div>
				  <div class="form-group">
                    <label for="gender" class="control-label">Gender:</label>
                    <input type="text" class="form-control" id="edit_gender" name="gender"/>
                  </div>
				  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="edit_email" name="email"/>
                  </div>
				  <div class="form-group">
                    <label for="password" class="control-label">Password:</label>
                    <input type="text" class="form-control" id="edit_password" name="password"/>
                  </div>
				  <div class="form-group">
                    <label for="hiredate" class="control-label">Hire Date:</label>
                    <input type="date" class="form-control" id="edit_hiredate" name="hiredate"/>
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


<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Record</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_del">
				<input type="hidden" value="delete" name="action" id="action">
				<input type="hidden" value="0" name="delete_id" id="delete_id">
				 <p>Delete this Employee?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_del" class="btn btn-primary">OK</button>
            </div>
			</form>
        </div>
    </div>
</div>
		  
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#emp_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "empResponse.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
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
                                $('#edit_name').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_address').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_contact').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_role').val(ele.siblings(':nth-of-type(5)').html());
                                $('#edit_gender').val(ele.siblings(':nth-of-type(6)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(7)').html());
                                $('#edit_password').val(ele.siblings(':nth-of-type(8)').html());
                                $('#edit_hiredate').val(ele.siblings(':nth-of-type(9)').html());
					} 
    })
	
	
	 grid.find(".command-delete").on("click", function(e)
    {
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();

		$('#delete_model').modal('show');
if($(this).data("row-id") !=0) {
						$('#delete_id').val(ele.siblings(':first').html());
					} 
    })
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "empResponse.php",  
				  data: data,
				  dataType: "json",       
				  success: function(empResponse)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#emp_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
		 	 $( "#btn_del" ).click(function() {
			  ajaxAction('delete');
			});  
});
</script>
