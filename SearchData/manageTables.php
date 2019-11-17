<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tables Records</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<link href="styleadmin.css" rel="stylesheet"/>
</head>

<nav class="nav">
		<ul>
			<li><a href="menuSP.php">MANAGE MENU</a></li>
			<!--<li class="dropdown">
				<a href="category.html" class="dropbtn">SALES REPORT</a>
					<div class="dropdown-content">
					</div>
			</li>-->
			
			<li><a href="tbSP.php">MANAGE TABLE</a></li>
			<li><a href="empSP.php">MANAGE EMPLOYEE</a></li>
			<li><a href="payment1.php">SEARCH PAYMENT</a></li>
		</ul>
</nav>
<body>
	<div class="container">
      <div class="">
        <h1>Tables Records</h1>
        <div class="col-sm-8">
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
		<table id="tables_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="tableno" data-type="numeric" data-identifier="true">Table No</th>
					<th data-column-id="servestatus">Serve Status</th>
					<th data-column-id="reservedate">Reserve Date</th>
					<th data-column-id="reservetime">Reserve Time</th>
					<th data-column-id="availability">Availability</th>
					<th data-column-id="amt">Amount</th>
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
                <h4 class="modal-title">Add Table</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="servestatus" class="control-label">Serve Status:</label>
                    <input type="text" class="form-control" id="servestatus" name="servestatus"/>
                  </div>
                  <div class="form-group">
                    <label for="reservedate" class="control-label">Reserve Date:</label>
                    <input type="date" class="form-control" id="reservedate" name="reservedate"/>
                  </div>
				  <div class="form-group">
                    <label for="reservetime" class="control-label">Reserve Time:</label>
                    <input type="time" class="form-control" id="reservetime" name="reservetime"/>
                  </div>
				  <div class="form-group">
                    <label for="availability" class="control-label">Availability:</label>
                    <input type="text" class="form-control" id="availability" name="availability"/>
                  </div>
				  <div class="form-group">
                    <label for="amt" class="control-label">Amount:</label>
                    <input type="text" class="form-control" id="amt" name="amt"/>
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
                <h4 class="modal-title">Edit Table</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label for="servestatus" class="control-label">Serve Status:</label>
                    <input type="text" class="form-control" id="edit_servestatus" name="edit_servestatus"/>
                  </div>
                  <div class="form-group">
                    <label for="reservedate" class="control-label">Reserve Date:</label>
                    <input type="date" placeholder="yyyy-mm-dd" class="form-control" id="edit_reservedate" name="edit_reservedate"/>
                  </div>
				  <div class="form-group">
                    <label for="reservetime" class="control-label">Reserve Time:</label>
                    <input type="time" class="form-control" id="edit_reservetime" name="edit_reservetime"/>
                  </div>
				  <div class="form-group">
                    <label for="availability" class="control-label">Availability:</label>
                    <input type="text" class="form-control" id="edit_availability" name="edit_availability"/>
                  </div>
				  <div class="form-group">
                    <label for="amt" class="control-label">Amount:</label>
                    <input type="text" class="form-control" id="edit_amt" name="edit_amt"/>
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
				 <p>Delete this Table?</p>
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
	var grid = $("#tables_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "tablesResponse.php",
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
                                $('#edit_servestatus').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_reservedate').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_reservetime').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_availability').val(ele.siblings(':nth-of-type(5)').html());
                                $('#edit_amt').val(ele.siblings(':nth-of-type(6)').html());
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
				  url: "tablesResponse.php",  
				  data: data,
				  dataType: "json",       
				  success: function(tablesResponse)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#tables_grid").bootgrid('reload');
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
		 	 $( "#btn_del" ).click(function() {
			  ajaxAction('delete');
			});  
});
</script>
