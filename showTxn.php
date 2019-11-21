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
<!--<style>
.bootgrid-table{
	table-layout: auto;
}
</style>-->
<script>
	function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
	}
	
	function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
	</script>
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
        <h1>Transaction Records</h1> 
		<div class="well clearfix">
			<div class="pull-right">
			<button onClick="exportTableToCSV('ShowTXN.csv')" class="bttn">Generate CSV</button>
			<a href="summary.php">
			<button type="button"  class="bttn" >Summary Report</button></a>
			</div></div>
		<table id="data_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="transactionid" data-type="numeric" data-identifier="true">Transaction ID</th>
					<th data-column-id="orderid">Order ID</th>
					<th data-column-id="datetime">Datetime</th>
					<th data-column-id="qty">Quantity</th>
					<th data-column-id="foodcode">Food Code</th>
					<th data-column-id="dishname">Dish Name</th>
					<th data-column-id="amt">Amount</th>
					<th data-column-id="balance">Balance</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
	
<!--Add Form--><!--
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
                    <label for="img" class="control-label">Image:</label>
                    <input type="text" class="form-control" id="img" name="img"/>
                  </div>
                  <div class="form-group">
                    <label for="dishname" class="control-label">Dish Name:</label>
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
		<!--Close/Save button--><!--	  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>

<!--Edit Form--><!--
<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Menu</h4>  
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
				  <div class="form-group">
                    <label for="edit_img" class="control-label">Image:</label>
                    <input type="text" class="form-control" id="edit_img" name="edit_img"/>
                  </div>
                  <div class="form-group">
                    <label for="edit_dishname" class="control-label">Dish Name:</label>
                    <input type="text" class="form-control" id="edit_dishname" name="edit_dishname"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_desc" class="control-label">Category:</label>
                    <input type="text" class="form-control" id="edit_desc" name="edit_desc"/>
                  </div>
				  <div class="form-group">
                    <label for="edit_price" class="control-label">Price:</label>
                    <input type="text" class="form-control" id="edit_price" name="edit_price"/>
                  </div>
         <!--Close/Save button--><!--
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>-->
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
				foodcode: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "txnResponse.php", 
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.foodcode + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.foodcode + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
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
                                $('#edit_dishname').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_desc').val(ele.siblings(':nth-of-type(3)').html());
								$('#edit_price').val(ele.siblings(':nth-of-type(4)').html());
								$('#edit_img').val(ele.siblings(':nth-of-type(5)').html());
					} else {
					 alert('No row selected! First select row, then click edit button');
					}
					
	// Delete data execution				
    }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){        
                                $.post('txnResponse.php', { foodcode: $(this).data("row-id"), action:'delete'}
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
				  url: "txnResponse.php", 
				  data: data,
				  dataType: "json",       
				  success: function(txnResponse)   
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
