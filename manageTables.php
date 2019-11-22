e<!DOCTYPE html>
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
	
			<li><a href="http://localhost/dpp2/LoginRegister/">LOGOUT</a></li>
		</ul>
</nav>


<body>
	<div class="container">
      <div class="">
        <h1>Table Records</h1>   
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
		<table id="data_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="5" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="tableno" data-type="numeric" data-identifier="true">Table No</th>
					<th data-column-id="servestatus">Reserve</th>
					<th data-column-id="reservedate">Date</th>
					<th data-column-id="reservetime">Time</th>
					<th data-column-id="reservename">Name</th>
					<th data-column-id="availability">Available</th>
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
                <h4 class="modal-title">Add Table</h4>   <!--change here oso-->
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
                    <label for="reservename" class="control-label">Reserve Name:</label>
                    <input type="text" class="form-control" id="reservename" name="reservename"/>
                  </div>
				  <div class="form-group">
                    <label for="availability" class="control-label">Availability:</label>
                    <input type="text" class="form-control" id="availability" name="availability"/>
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
                <h4 class="modal-title">Edit Table</h4>  
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
				  <div class="form-group">
                    <label for="edit_status" class="control-label">Serve Status:</label>
                    <input type="text" class="form-control" id="edit_status" name="edit_status"/>
                  </div>
                  <div class="form-group">
                    <label for="edit_date" class="control-label">Reserve Date:</label>
                    <input type="date" class="form-control" id="edit_date" name="edit_date"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_time" class="control-label">Reserve Time:</label>
                    <input type="time" class="form-control" id="edit_time" name="edit_time"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_name" class="control-label">Reserve Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_availability" class="control-label">Availability:</label>
                    <input type="text" class="form-control" id="edit_availability" name="edit_availability"/>
                  </div>
         <!--Close/Save button-->
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
			// To accumulate custom parameter with the request object 
			return { 
				tableno: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "tablesResponse.php",  
		formatters: {
		        "commands": function(column, row)
		        {																						//Here oso need to change id accordingly
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.tableno + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.tableno + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    // Executes after data is loaded and rendered 
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
                                $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                                $('#edit_status').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_date').val(ele.siblings(':nth-of-type(3)').html());
								$('#edit_time').val(ele.siblings(':nth-of-type(4)').html());
								$('#edit_name').val(ele.siblings(':nth-of-type(5)').html());
								$('#edit_availability').val(ele.siblings(':nth-of-type(6)').html());
					} else {
					 alert('No row selected! First select row, then click edit button');
					}
					
	// Delete data execution				
    }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){         
                                $.post('tablesResponse.php', { tableno: $(this).data("row-id"), action:'delete'}
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
				  url: "tablesResponse.php", 
				  data: data,
				  dataType: "json",       
				  success: function(tablesResponse)  
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
