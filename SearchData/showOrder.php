<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Records</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<link href="styleadmin.css" rel="stylesheet"/>
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
        <h1>Order Records</h1>
        <div class="col-sm-8">
		<div class="well clearfix"></div>
		<table id="order_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="orderid" data-type="numeric" data-identifier="true">Order ID</th>
					<th data-column-id="empid">Employee ID</th>
					<th data-column-id="amt">Amount</th>
					<th data-column-id="qty">Quantity</th>
					<th data-column-id="datetime">Date Time</th>
					<th data-column-id="tableno">Table No</th>
					<th data-column-id="foodcode">Food Code</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>  
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#order_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "orderSP.php",
		formatters: {
		        "commands": function(row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
	
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
				  url: "orderSP.php",  
				  data: data,
				  dataType: "json",       
				  success: function(orderSP)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#order_grid").bootgrid('reload');
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
