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
	<meta name="author" content="Ashley">
	<title>Summary</title>
	
	<link href="style.css" rel="stylesheet"/>
	<style>
	body 
	{
		background-color: #add8e6;
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
	</script>
	
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dishname', 'Quantity'],
          <?php
			$sql="SELECT dishname,qty from ordertable GROUP BY dishname";
			$sqqql=mysqli_query($conn,$sql);
			while($res=mysqli_fetch_assoc($sqqql)){
			echo"['".$res['dishname']."',".$res['qty']."],";
			}
		  ?>
		  
        ]);

        var options = {
          title: 'Daily Sales Report',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>

<body>

<table id="orderdatalist" style="width:100%">
<h1>Summary Report</h1>

<script>
	function renderTime()
		{
			var mydate = newDate();
			var year = mydate.getYear();
			if(year <1000)
				{
					year+=1900
				
				}
			var day=mydate.getDay();
			var month=mydate.getMonth();
			var daym=mydate.getDate();
			var dayarray=new Array("Sunday","Monday","Tuseday","Wednesday","Thursday","Friday","Saturday);
			var montharray=	new Array("January","february","March","April","May","June","July","August","September","October","November","December");
			
			var currentTime = new Date();
			var h = currentTime.getHours();
			var m = currentTime.getMinutes();
			var s = currentTime.getSeconds();
			if(h==24)
			{
				h=0;
				
			}
			else if(h>12)
			{
				h=h-0;
			}
			
			if(h<10)
				{
					h="0"+h;
			
				}
			if(m<10)
				{
					m="0"+m;
				}
			if(s<10)
				{
					s="0"+s;
				}
			var myclock =document.getElementById("clockDisplay");
			myclock.textContent="" +dayarray[day]+ "" +daym+ "" +montharray[month]+ "" +year+ "|" +h+ ":" +m+ ":" +s;
			myclock.innerText ="" +dayarray[day]+ "" +daym+ "" +montharray[month]+ "" +year+ "|" +h+ ":" +m+ ":" +s;
			
			setTimeout("renderTime()",1000);
		}
	renderTime();
	
	
</script>



		<table class="showtable">
		<tr>
			<td>Date</td>
			<td>Food Code</td>
			<td>Dish Name</td>
			<td>Total Amount</td>
			<td>Quantity</td>
		</tr>
		<?php
		echo "<strong>Date : </strong>" . date("Y/m/d") . date(" (l)"). "<br>";
		
		echo"</br>";
		$result = mysqli_query($conn, "SELECT datetime,foodcode,dishname,amt,qty FROM ordertable
								GROUP BY (dishname)
								ORDER BY orderid");
		
		
		while ($row = mysqli_fetch_assoc($result)){
			
		?>
		
		<tr>
		    <td><?php echo $row['datetime']; ?></td>
			<td><?php echo $row['foodcode']; ?></td>
			<td><?php echo $row['dishname']; ?></td>
			<td><?php echo $row['amt']; ?></td>
			<td><?php echo $row['qty']; ?></td>

		</tr>
		
		<?php }; ?>
	
	</table>
	
	</br>
	</br>
	 <div id="piechart_3d" style="width: 800px; height: 400px;"></div>
	<button onClick="exportTableToCSV('Dailysummary.csv')" class="btn">Generate CSV</button>
  </body>
</html>