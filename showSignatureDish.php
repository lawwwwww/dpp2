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
		
		<h1 align = "center"><?php
		//$maxnum=0;
		//$max=' ';
		$sql = mysqli_query($conn,"SELECT foodcode,dishname,MAX(qty) FROM paymenttable");
		if(mysqli_num_rows($sql)>0)
		{
			while($row=mysqli_fetch_array($sql))
			{	
	?><img id="cro" src="crown.png" height="80" width="80"/>
<?php
		echo $row["dishname"];
						?><br/><?php
			$geti="SELECT img from menutable where foodcode=$row[foodcode]";
			
				$ima=mysqli_query($conn,$geti);
				if(mysqli_num_rows($ima)>0)
				{
					while($row=mysqli_fetch_array($ima))
					{
						?>
	<img src="<?php echo $row["img"];?>" height="400" width="400"/>
						<?php	
					}
				}
					
			}
		}
		
				
		
		
		
		/*
		 while($rere = $sql->fetch_assoc()){
			 if($rere['qty']>$maxnum){
				 $max=$rere['dishname'];
				 $maxnum=$max;
			 }
		} 
		echo $max;
		while($rere=$sql->fetch_assoc())
		{
			if($max==$rere['dishname'])
			{
				
			}
		}*/
		?></div></div>
</body>
</html>
