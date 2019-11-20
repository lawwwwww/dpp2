<?php
$conn=mysqli_connect("localhost","root","","cafedb");
		$ee=$_COOKIE['emppa'];
							
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
			<li><a href="main.php">HOME</a></li>
			<li><a href="showtable.php">TABLE SUMMARY</a></li>
			<li><a href="showSignatureDish.php">SIGNATURE FOOD</a></li>
			<li><a href="http://localhost/dpp2/LoginRegister/">LOGOUT</a></li>
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
						date_default_timezone_set("Asia/Kuala_Lumpur");
						$datee =  date('Y-m-d');
						$timee=date('H:i');
						$todayt="UPDATE tablestable set reservedate=null,reservetime=null,reservename='' where reservedate < '$datee' or (reservedate='$datee' and reservetime<='$timee')";
						mysqli_query($conn,$todayt);
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
														
							
	<td><a href="coo.php?empid=<?php echo $ee;?>&tableno=<?php echo $row["tableno"]?>">Add/View order  </a> 	<?php
		if($row["reservedate"]==null)
		{
			?> | 
	
		<a href="form.php?tableno=<?php echo $row["tableno"]?>">Reserve</a></td>					
		<?php
		}
		?>			
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