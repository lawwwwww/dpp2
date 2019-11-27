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
			<li><a href="LoginRegister">LOGOUT</a></li>
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
		
		<h1 align = "center">
	<?php	

$sql = mysqli_query($conn,"SELECT MAX(x.qt) as ma
FROM (SELECT SUM(qty) as qt from paymenttable GROUP BY foodcode)x");

		if(mysqli_num_rows($sql)>0)
	{
			while($row=mysqli_fetch_array($sql))
		{
			$ty=$row["ma"];
			?>
			
	<?php
		
		
		}
	}
	
	?>
	
	<?php
	$tr=mysqli_query($conn,"SELECT foodcode,dishname,SUM(qty) as qt FROM paymenttable GROUP BY foodcode");
	
	if(mysqli_num_rows($tr)>0)
	{
		while($rr=mysqli_fetch_array($tr))
		{
			if($rr["qt"]==$ty)
			{
	?>	
	<img id="cro" src="crown.png" height="80" width="80"/>
		
		<?php
		$tt=$rr["foodcode"];
		echo $rr["dishname"];
		
		$ll=mysqli_query($conn,"SELECT img,foodcode,dishname,price FROM menutable WHERE foodcode=$tt");
		if(mysqli_num_rows($ll)>0)
		{
			while($hh=mysqli_fetch_array($ll))
			{
				?><br/>
	<img src="<?php echo $hh["img"];?>" height="450" width="450"/><br/>
			<?php
			
			echo "RM ";
			echo $hh["price"];}
		}
		
		?>
	<br/>	<br/>
		
	<?php
		}
	}}
	?>
	

	</div></div>
</body>
</html>
