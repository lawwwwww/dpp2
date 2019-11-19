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
	<link href="form.css" rel="stylesheet"/>
<script src="validate.js"></script>
	
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
<section class="res">
<h1 class="tableform">Reserve Table Form for table <?php echo $tabble;?></h1>
<br/>
<div class="cc">
	<form id="form" method="post" action="showtable.php" novalidate="novalidate">
	<div class="row">
		<div class="col-25">
			<label for="fname">Name:</label>
			</div>
			<div class="col-75">
			<input type="text" name="name" id="name" placeholder="Name" required="required">
		</div>
	</div>
	<div class="row">
		<div class="col-25">
			<label for="da">Reserve date:</label>
			</div>
			<div class="col-75">
			<input type="date" name="date" id="preferday" width="300px" placeholder="reserve date" required="required"/>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="ti">Reserve time:</label>
			</div>
			<div class="col-75">
			<input type="time" name="time" id="time" placeholder="reserve time" required="required"/>
		</div>
	</div>
	
	  <div class="row">
    <div class="col-25">
      <label for="subject">Remark</label>
    </div>
    <div class="col-75">
      <textarea id="remark" name="remark" placeholder="Write something.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    	<input type="hidden" name="tablenu" value="<?php echo $tabble;?>"/>
		<input type="submit" name="add_form" value="Submit"/>
	
  </div>
	
	</form> </div>
	</section>
</body>
</html>
