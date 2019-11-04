<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="CafePOS_adminOrderTable">
	<meta name="author" content="Mary">
	<title>Order Data</title>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
	
	<style>
	body {
		background-color: powderblue;
	}
	.dataTables_wrapperr.dataTables_paginate._paginate_button.current:hover{
		color: #000 !important;
		background-color: white;
	}
		
	</style>
</head>

<body>

<table id="orderdatalist">
<h1>Menu List</h1>
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Employee ID</th>
			<th>Table No</th>
			<th>Food Code</th>
			<th>Dish Name</th>
			<th>Total Amount</th>
			<th>Quantity</th>
			<th>Datetime</th>
		</tr>
	</thead>
	
<!-- fetch data table from DB -->
	<tbody>
		<?php
		$conn = mysqli_connect("localhost", "root", "", "cafedb");
		$result = mysqli_query($conn, "SELECT * FROM ordertable");
		
		while ($row = mysqli_fetch_assoc($result)):
		?>
		
		<tr>
			<td><?php echo $row['orderid']; ?></td>
			<td><?php echo $row['empid']; ?></td>
			<td><?php echo $row['tableno']; ?></td>
			<td><?php echo $row['foodcode']; ?></td>
			<td><?php echo $row['dishname']; ?></td>
			<td><?php echo $row['amt']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><?php echo $row['datetime']; ?></td>
		</tr>
		
		<?php endwhile; ?>
	</tbody>
</table>

</body>

<!--implement search and pagination-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function()
	{
    $('#orderdatalist').DataTable();
	} );
</script>