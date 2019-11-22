<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Daily Signature Dish</title>
<link href="style.css" rel="stylesheet"/>
<link href="sig.css" rel="stylesheet"/>
</head>

<nav class="nav">
		<ul>
			<li><a href="main.php">HOME</a></li>
			<li><a href="showtable.php">TABLE SUMMARY</a></li>
			<li><a href="showSignatureDish.php">SIGNATURE FOOD</a></li>
			<li><a href="http://localhost/dpp2/LoginRegister/">LOGOUT</a></li>
		</ul>
</nav>
<body>
<br/>
	<div class="cc">
      <div class="">
	  
	  <br/>
	  <br/>
        <h1 align = "center"> \^O^/ Signature Dish \^O^/ </h1>
		<br/>
		<br/>
		
		<h1 align = "center">
	<?php	$sql = mysqli_query($conn,"SELECT foodcode,dishname,SUM(qty) as sumqty FROM paymenttable GROUP BY foodcode ORDER BY sumqty asc");
		

		if(mysqli_num_rows($sql)>0)
	{
			while($row=mysqli_fetch_array($sql))
		{
			$tt=$row["foodcode"];	
		}
	}
	
	?>
	
	<?php
		$qq=mysqli_query($conn,"SELECT foodcode, dishname,img,price from menutable where foodcode=$tt");
		if(mysqli_num_rows($qq)>0)
		{
			while($ww=mysqli_fetch_array($qq))
			{
	?>
	<img id="cro" src="crown.png" height="80" width="80"/>
	
	<?php
		echo $ww["dishname"];
		?><br/>
	<img src="<?php echo $ww["img"];?>" height="400" width="400"/><br/>
	
	<?php
	echo "RM ";
	echo $ww["price"];
	?>
	<br/>

	<?php	
					
			}
		}
?>	</div></div>
</body>
</html>
