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
</head>
<body>
	<div class="container">
      <div class="">
	  <br/>
	  <br/>
	  <br/>
	  <br/>
        <h1 align = "center"> \^O^/ Today Signature Dish \^O^/ </h1>
		<br/>
		<br/>
		<br/>
		<h1 align = "center"><?php
		$maxnum=0;
		$max=' ';
		$sql = mysqli_query($conn,"SELECT qty,dishname FROM paymenttable");
		 while($rere = $sql->fetch_assoc()){
			 if($rere['qty']>$maxnum){
				 $max=$rere['dishname'];
			 }
		} 
		echo $max;
		?></h2>
</body>
</html>