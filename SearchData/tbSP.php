<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="CafePOS_adminTablesTable">
	<meta name="author" content="Mary">
	<title>Tables Data</title>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
	
	<style>
	body 
	{
		background-color: #F8C471;
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button:hover
	{
		border:1px solid #ADD8E6;
		background-color: #ADD8E6;
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #ADD8E6), color-stop(100%, #ADD8E6));
		background:-webkit-linear-gradient(top, #ADD8E6 0%,#87CEEB 100%);
		background:-moz-linear-gradient(top,  #ADD8E6 0%, #87CEEB 100%);
		background:-ms-linear-gradient(top, #ADD8E6 0%, #87CEEB 100%);
		background:-o-linear-gradient(top,  #ADD8E6 0%, #87CEEB 100%);
		background:linear-gradient(to bottom, #ADD8E6 0%, #87CEEB 100%)
	}
	</style>
</head>

<body>

<table id="tablesdatalist">
<h1>Tables List</h1>
	<thead>
		<tr>
			<th>Table No</th>
			<th>Serve Status</th>
			<th>Reserve Date</th>
			<th>Availibility</th>
			<th>Total Amount</th>
		</tr>
	</thead>
	
<!-- fetch data table from DB -->
	<tbody>
		<?php
		$conn = mysqli_connect("localhost", "root", "", "cafedb");
		$result = mysqli_query($conn, "SELECT * FROM tablestable");
		
		while ($row = mysqli_fetch_assoc($result)):
		?>
		
		<tr>
			<td><?php echo $row['tableno']; ?></td>
			<td><?php echo $row['servestatus']; ?></td>
			<td><?php echo $row['reservedate']; ?></td>
			<td><?php echo $row['availability']; ?></td>
			<td><?php echo $row['amt']; ?></td>
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
    $('#tablesdatalist').DataTable();
	} );
</script>