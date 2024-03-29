
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cafe</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<link href="styleadmin.css" rel="stylesheet"/>
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<script src="dropdownmenu.js"></script>
</head>

<nav class="nav">
		<ul>
			<li><a href="mainadmin.php">HOME</a></li>
			<li class="dropdown">
				<a class="dropbtn" onmouseover="showmanage()">MANAGE</a>
				<div class="dropdown-content">
				<p id ="manage"></p>
				</div>
				</li>
			
			<li class="dropdown">
				<a class="dropbtn" onmouseover="showpayment()">PAYMENT</a>
				<div class="dropdown-content">
				<p id="about"></p></div>
			</li>
	
			<li><a href="LoginRegister">LOGOUT</a></li>
		</ul>
</nav>

<body>
	<div class="container">
      <div class="">
        <h1>Employee Records</h1>
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
		<table id="data_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="5" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="empid" data-type="numeric" data-identifier="true">Employee ID</th>
					<th data-column-id="name">Name</th>
					<th data-column-id="address">Address</th>
					<th data-column-id="contactinfo">Contact</th>
					<th data-column-id="role">Role</th>
					<th data-column-id="gender">Gender</th>
					<th data-column-id="email">Email</th>
					<th data-column-id="password" data-type="password">Password</th>
					<th data-column-id="hiredate">Hire Date</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
	
<!--Add Form-->
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
					<select name="role" id="role" required type="text" class="form-control">
						<option value="Staff">Staff</option>
						<option value="Admin">Admin</option>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="gender" class="control-label">Gender:</label>
                    <select name="gender" id="gender" required type="text" class="form-control">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"/>
                  </div>
				  <div class="form-group">
                    <label for="password" class="control-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" data-type="password"/>
                  </div>
				  <div class="form-group">
                    <label for="hiredate" class="control-label">Hire Date:</label>
                    <input type="date" class="form-control" id="hiredate" name="hiredate"/>
                  </div>
			<!--Close/Save button-->	  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>

<!--Edit Form-->
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
                    <label for="edit_name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name"/>
                  </div>
                  <div class="form-group">
                    <label for="edit_address" class="control-label">Address:</label>
                    <input type="text" class="form-control" id="edit_address" name="edit_address"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_contact" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="edit_contactinfo" name="edit_contactinfo"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_role" class="control-label">Role:</label>
					<select name="edit_role" id="edit_role" required type="text" class="form-control">
						<option value="Staff">Staff</option>
						<option value="Admin">Admin</option>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="edit_gender" class="control-label">Gender:</label>
					<select name="edit_gender" id="edit_gender" required type="text" class="form-control">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
                  </div>
				  <div class="form-group">
                    <label for="edit_email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_password" class="control-label">Password:</label>
                    <input type="password" class="form-control" id="edit_password" name="edit_password" data-type="password"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_hiredate" class="control-label">Hire Date:</label>
                    <input type="date" class="form-control" id="edit_hiredate" name="edit_hiredate"/>
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
</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#data_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				empid: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "empResponse.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.empid + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.empid + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
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
console.log(g_id);
                    console.log(g_name);
					
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                                // collect the data
								$('#edit_id').val(ele.siblings(':first').html()); 
								// in case we're changing the key
                                $('#edit_name').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_address').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_contactinfo').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_role').val(ele.siblings(':nth-of-type(5)').html());
                                $('#edit_gender').val(ele.siblings(':nth-of-type(6)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(7)').html());
                                $('#edit_password').val(ele.siblings(':nth-of-type(8)').html());
                                $('#edit_hiredate').val(ele.siblings(':nth-of-type(9)').html());
					} else {
					 alert('No row selected! First select row, then click edit button');
					}
    }) .end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){         
                                $.post('empResponse.php', { empid: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#data_grid").bootgrid('reload');
                                }); 
                    }
    });
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
					$("#data_grid").bootgrid('reload');
				  }
				});
			}		
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function(e) {
			  ajaxAction('edit');
			});
});
</script>

