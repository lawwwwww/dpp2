<?php
$conn=mysqli_connect("localhost","root","","cafedb");
				
	if($conn->connect_error)
	{
		die("Connection failed:".$conn->connect_error);
	}
	
	if(isset($_POST["add_form"]))
	{
		$form="UPDATE tablestable SET reservedate='$_POST[date]',reservetime='$_POST[time]',reservename='$_POST[name]' 
		where tableno=$_POST[tablenu]";
		mysqli_query($conn,$form);
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
    

    <!-- Main content -->
    <section class="content" >
	<h1 class="tablesum">Table Summary</h1>
        <div class="row">
            <div class="col-xs-12">
			
                <div class="box">
                    <!-- /.box-header -->
								<br/>
								<table class="showtable">
								<tr>
								<td><strong>Table No</strong></td>
								<td><strong>Serve Status </strong></td>
								
								<td><strong>Availability </strong></td>
								<td><strong>Reserve Date </strong></td>
							<td><strong>Reserve Time </strong></td>
							<td><strong>Reserve Name </strong></td>
								<td><strong>Action </strong></td>
								</tr>
				<?php	
						
						$sql="SELECT * from tablestable";	
						$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)>0)
					{	while($row=mysqli_fetch_array($result))
						{	
							
			?>		
					<tr>
							<td>		
							<?php echo $row["tableno"];?></td>
							
							<td>
							<?php echo $row["servestatus"];?></td>
							

							<td>
							<?php echo $row["availability"];?></td>
							<td>
							<?php echo $row["reservedate"];?></td>
							
	<td>
							<?php echo $row["reservetime"];?></td>
							<td>
							<?php echo $row["reservename"];?></td>
														
							
	<td><a href="menu.php?tableno=<?php echo $row["tableno"]?>">Add/View order</a> | <a href="form.php?tableno=<?php echo $row["tableno"]?>">Reserve</a></td>					
						
				<?php }}?>
			
			<?php
				
				
				$conn->close();			
			?>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</body>
</html>