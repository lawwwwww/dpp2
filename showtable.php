

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
        <div class="row">
            <div class="col-xs-12">
			
                <div class="box">
                    <!-- /.box-header -->
								<br/>
								<table class="showtable" border="1">
								<tr>
								<td><strong>Table No</strong></td>
								<td><strong>Serve Status </strong></td>
								<td><strong>Reserve Date </strong></td>
								<td><strong>Availability </strong></td>
								<td><strong>Amount </strong></td></tr>
       		<?php
					$conn=mysqli_connect("localhost","root","","cafedb");
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
							
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
							
							<td><?php echo $row["reservedate"];?></td>
							
							<td><?php echo $row["availability"];?></td>
							<td><?php echo $row["amt"];?></td>
							
							
							</tr>
					
				<?php }}?></table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    

</body>
</html>

<?php $conn->close();?>