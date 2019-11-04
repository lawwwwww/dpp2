<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="CafePOS_adminEmployeeTable">
	<meta name="author" content="Mary">
	<title>Employee Data</title>
	
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

<table id="empdatalist">
<h1>Employee List</h1>
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Role</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Password</th>
			<th>Hire Date</th>
		</tr>
	</thead>
	
<!-- fetch data table from DB -->
	<tbody>
		<?php
		$conn = mysqli_connect("localhost", "root", "", "cafedb");
		$result = mysqli_query($conn, "SELECT * FROM employeetable");
		
		while ($row = mysqli_fetch_assoc($result)):
		?>
		
		<tr>
			<td><?php echo $row['empid']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['contactinfo']; ?></td>
			<td><?php echo $row['role']; ?></td>
			<td><?php echo $row['gender']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['password']; ?></td>
			<td><?php echo $row['hiredate']; ?></td>
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
    $('#empdatalist').DataTable();
	} );
</script>
