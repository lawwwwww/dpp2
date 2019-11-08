<?php
	$conn=mysqli_connect("localhost","root","","cafedb");
	if($conn->connect_error)
	{
		die("Connection failed:".$conn->connect_error);
	}
	
	if(isset($_GET['tableno']))
	{
		$tabble=mysqli_real_escape_string($conn,$_GET['tableno']);
	}
	

?>

<!DOCTYPE html>
<html lang="eng">
<head>
<title>Cafe</title>
    <!--meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cafe">
	<link href="style.css" rel="stylesheet"/>
</head>

	
<nav class="nav">
		<ul>
			<li><a href="index.html">HOME</a></li>
			<li class="dropdown">
				<a href="category.html" class="dropbtn">CATEGORY</a>
					<div class="dropdown-content">
					</div>
			</li>
			
			<li><a href="enquiry.html">FORM</a></li>
			<li><a href="Disclaimer.html">DISCLAMER</a></li>
			<li><a href="enhancement.html">ENHANCEMENT</a></li>
		</ul>
</nav>
<body>
<h1 class="tableform">Reserve Table Form for table <?php echo $tabble;?></h1>
<br/>
	<form method="post" action="showtable.php">
		Name:<br/>
		<input type="text" name="name" placeholder="Name"/>
		<br/>
		<br/>
		
		Reserve date:<br/>
		<input type="date" name="date" placeholder="reserve date"/>
		<br/><br/>
		
		Reserve time:<br/>
		<input type="time" name="time" placeholder="reserve time"/>
		<br/><br/>
		
		<input type="hidden" name="tablenu" value="<?php echo $tabble;?>"/>
		<input type="submit" name="add_form" value="Submit"/>
	</form> 
</body>
</html>