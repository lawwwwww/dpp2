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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cafe</title>

	<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
	<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
	<script src="dist/jquery-1.11.1.min.js"></script>
	<script src="dist/bootstrap.min.js"></script>
	<script src="dist/jquery.bootgrid.min.js"></script>
	<script src="dropdownmenu.js"></script>
	<link href="styleadmin.css" rel="stylesheet"/>

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
<div class="container">
      <div class="">
     
<h1>Transaction List</h1>
<div class="well clearfix">
			<div class="pull-right">
			<button onClick="exportTableToCSV('TransactionList.csv')" class="bttn">Generate CSV</button>
<a href="summary.php">
   <button type="button"  class="bttn" >Summary Report</button>
   </a>
			</div></div>
		
<table id="orderdatalist"  class="table table-condensed table-hover table-striped" width="100%" cellspacing="5" data-toggle="bootgrid">
	<thead>
		<tr>
			<th>Transaction ID</th>
			<th>Order ID</th>
			<th>Datetime</th>
			<th>Quantity</th>
			<th>Food Code</th>
			<th>Total Amount</th>
			<th>Balance</th>
	
		</tr>
	</thead>
	</div>
      </div>
    </div>
<!-- fetch data table from DB -->
	<tbody>
		<?php
		error_reporting(0);
		$result =  mysqli_query($conn, "SELECT * from paymenttable");
		
		while ($row = mysqli_fetch_assoc($result)):
		?>
		
		<tr>
			<td><?php echo $row['transactionid'] ?></td>
			<td><?php echo $row['orderid']; ?></td>
			<td><?php echo $row['datetime']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><?php echo $row['foodcode']; ?></td>
			<td><?php echo $row['amt']; ?></td>
			<td><?php echo $row['Balance']; ?></td>
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