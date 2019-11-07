         <?php 
					session_start();
					$conn=mysqli_connect("localhost","root","","cafedb");
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
					if(isset($_POST["add_to_cart"]))
					{
						
							$item_array=array(
								'item_id' => $_GET["id"],
								'item_name'     => $_POST["hidden_name"],
								'item_price'    => $_POST["hidden_price"],
								'item_description'=> $_POST["hidden_description"],
								'item_quantity'=>$_POST["quantity"]
							);
							
							$item_array_id=array_column($_SESSION["shopping_cart"],"item_id");
						
							$_SESSION["shopping_cart"][]=$item_array;
							
						
							$add="INSERT INTO ordertable (empid,amt,qty,tableno,foodcode,dishname)VALUES(2,'$_POST[hidden_price]','$_POST[quantity]',1,'$_GET[id]','$_POST[hidden_name]')";
							mysqli_query($conn,$add);
						
					}
					
					if(isset($_GET["action"]))
					{
						if($_GET["action"]=="delete")
						{
								
									$del="DELETE FROM ordertable where orderid=$_GET[id]";
									mysqli_query($conn,$del);
									echo'<script>alert("Are u sure u want to delete")</script>';
									echo '<script>window.location="menu.php"</script>';	
								
								}
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
    
    <br />
    
	

    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
			
                <div class="box">
                    <!-- /.box-header -->
								<br/>
                           
        <?php			$sql="SELECT * from menutable ORDER BY foodcode ASC";	
						$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)>0)
					{	while($row=mysqli_fetch_array($result))
						{
							?>
							<div style="width:75%;">
							<div class="responsive" style="margin-left:100px; width:15%;">
							
							<form method="post" action="menu.php?action=add&id=<?php echo $row["foodcode"];?>">
	
							<img src="<?php echo $row["img"];?>" height="200" width="200"/>
							<h4 class="text-info"><?php echo $row["dishname"];?></h4>
							<h4 class="text-danger">RM<?php echo $row["price"];?></h4>
							<input type="text" name="quantity" class="form-control" value="1" style="width:8%"/>
							<input type="hidden" name="hidden_name" value="<?php echo $row["dishname"];?>"/>
							<input type="hidden" name="hidden_price" value="<?php echo $row["price"]?>"/>
							<input type="hidden" name="hidden_description" value="<?php echo $row["description"];?>"/>
							<input type="hidden" name="hidden_foodcode" value="<?php echo $row["foodcode"];?>"/>
							<br/>
							<input type="submit" value="Add to cart" name="add_to_cart" style="margin-left:0px;" class="btn btn-success"/>
							
							</form>
					</div></div>
					</section>
					<?php }}?>
					<div class="sidenav" >
						<br/>
						<h3>Payment</h3>
						
							<table style="border:1px solid black;
		border-collapse:collapse; width=50%;">
							<tr  style="border:1px solid black;
		border-collapse:collapse;">
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Dishname</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Quantity</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Price</h3></td>
							</tr>
							<?php
							$total=0;
							$sql="SELECT * from ordertable ORDER BY foodcode ASC";	
						$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)>0)
					{	while($row=mysqli_fetch_array($result))
						{	
							?>
							<tr style="border:1px solid black;
								border-collapse:collapse;">
							<td style="border:1px solid black;
								border-collapse:collapse;"><h4>
							<?php echo $row["dishname"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4>
							<?php echo $row["qty"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4>RM<?php echo $row["amt"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4><?php echo number_format($row["qty"]*$row["amt"],2);?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4><a href="menu.php?action=delete&id=<?php echo $row["orderid"];?>">
							
							<span class="text-danger">Remove</span></a></h4></td>
							</tr>
						<?php
							$total=$total+($row["qty"]*$row["amt"]);}}
							
						?>
						
						<tr>
						<td colspan="2" style="align:right"><h3>Total</h3></td>
						<td style="align:right"><h3>RM<?php echo number_format($total,2);?></h3></td>
						<td></td>
						</tr>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

</body>
</html>

<?php $conn->close();?>
