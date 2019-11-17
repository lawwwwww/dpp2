<?php
	$conn=mysqli_connect("localhost","root","","cafedb");
	if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
					
		

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="CafePOS_adminOrderTable">
	<meta name="author" content="Mary">
	<title>Transaction Log</title>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
	
	<style>
	body 
	{
		background-color: #add8e6;
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

<body>
<table id="orderdatalist">
<h1>Transaction Log</h1>
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
			<th>Transaction ID</th>
	
		</tr>
	</thead>
	
<!-- fetch data table from DB -->
	<tbody>
		<?php
		$result =  mysqli_query($conn, "SELECT o.orderid,o.empid,o.tableno,o.foodcode,o.dishname,o.amt,o.qty,o.datetime,p.transactionid 
			FROM ordertable o 
			inner join paymenttable p 
			on o.orderid=p.orderid");
		
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
			<td><?php echo $row['transactionid'] ?></td>
		</tr>
		
		<?php endwhile; ?>
		
		<button onClick="exportTableToCSV('TransactionLog.csv')">Generate CSV</button>
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


<?php $conn->close();?>