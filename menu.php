         <?php 
					session_start();
					$conn=mysqli_connect("localhost","root","","cafedb");
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
					if(isset($_POST["add_to_cart"]))
					{
						if(isset($SESSION["shopping_cart"]))
						{
							$item_array_id=array_column($_SESSION["shopping_cart"],"item_id");
							if(!in_array($_GET["id"],$item_array_id))
							{
								$count=count($_SESSION["shopping_cart"]);
								$item_array=array(
								'item_id' => $_GET["id"],
								'item_name'     => $_POST["hidden_name"],
								'item_price'    => $_POST["hidden_price"],
								'item_description'=> $_POST["hidden_description"],
								'item_quantity'=>$_POST["quantity"]
							);
							$_SESSION["shopping_cart"][$count]=$item_array;
								
								$add="INSERT INTO ordertable (empid,amt,qty,datetime,tableno,foodcode)VALUES(2,'$_POST[hidden_price]','$_POST[quantity]',29/10/2019,1,'$_GET[id]')";
								
							mysqli_query($conn,$add);
							}
						}
						else
						{
							$item_array=array(
								'item_id' => $_GET["id"],
								'item_name'     => $_POST["hidden_name"],
								'item_price'    => $_POST["hidden_price"],
								'item_description'=> $_POST["hidden_description"],
								'item_quantity'=>$_POST["quantity"]
							);
					
							$_SESSION["shopping_cart"][]=$item_array;
							$add="INSERT INTO ordertable (empid,amt,qty,datetime,tableno,foodcode)VALUES(2,'$_POST[hidden_price]','$_POST[quantity]',29/10/2019,1,'$_GET[id]')";
							mysqli_query($conn,$add);
						}
					}
					
					if(isset($_GET["action"]))
					{
						if($_GET["action"]=="delete")
						{
							foreach($_SESSION["shopping_cart"] as $keys=>$values)
							{
								if($values["item_id"]==$_GET["id"])
								{
									unset($_SESSION["shopping_cart"][$keys]);
									$del="DELETE FROM ordertable where foodcode=$_GET[id]";
									mysqli_query($conn,$del);
									echo'<script>alert("Are u sure u want to delete)</script>';
									echo '<script>window.location="menu.php"</script>';	
								
								}
							}
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
	<link href = "enhancement.css" rel = "stylesheet"/>
    </head>
	
<nav class="nav">
		<ul>
			<li><a href="index.html">HOME</a></li>
			<li class="dropdown">
				<a href="category.html" class="dropbtn">CATEGORY</a>
					<div class="dropdown-content">
						<a href="product1.html">Houses</a>
						<a href="product2.html">Room</a>
						<a href="product3.html">Apartment</a>
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
							
							<div>
							<img src="<?php echo $row["img"];?>" height="200" width="200">
							<h4 class="text-info"><?php echo $row["dishname"];?></h4>
							<h4 class="text-danger">RM<?php echo $row["price"];?></h4>
							<input type="text" name="quantity" class="form-control" value="1" style="width:8%"/>
							<input type="hidden" name="hidden_name" value="<?php echo $row["dishname"];?>"/>
							<input type="hidden" name="hidden_price" value="<?php echo $row["price"]?>"/>
							<input type="hidden" name="hidden_description" value="<?php echo $row["description"];?>"/>
							<input type="hidden" name="hidden_foodcode" value="<?php echo $row["foodcode"];?>"/>
							<br/>
							<input type="submit" value="Add to cart" name="add_to_cart" style="margin-left:0px;" class="btn btn-success"/>
							</div>
							</div>
							
							</form>
					</div>
					</section>
					<?php }}?>
					<div class="sidenav" style="
	margin:10px;
    height: 100%;
    width: 25%;
    position: fixed;
    z-index: 0;
    top: 0;
    right: 0;
	float:right;
    overflow-x: hidden;
    padding: 60px 10px 10px 10px;">
						<br/>
						<h3>Order Details</h3>
						
							<table style="border:1px solid black;
		border-collapse:collapse; width=50%;">
							<tr  style="border:1px solid black;
		border-collapse:collapse;">
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Item Name</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Quantity</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Price</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Total</h3></td>
							<td style="border:1px solid black;
		border-collapse:collapse;"><h3>Action</h3></td>
							</tr>
							<?php
							$total=0;
							if(!empty($_SESSION["shopping_cart"]))
							{
								
								foreach($_SESSION["shopping_cart"]as $keys => $values)
								{
							
							?>
							<tr style="border:1px solid black;
								border-collapse:collapse;">
							<td style="border:1px solid black;
								border-collapse:collapse;"><h4>
							<?php echo $values["item_name"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4>
							<?php echo $values["item_quantity"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4>RM<?php echo $values["item_price"];?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4><?php echo number_format($values["item_quantity"]*$values["item_price"],2);?></h4></td>
							
							<td style="border:1px solid black;
							border-collapse:collapse;"><h4><a href="menu.php?action=delete&id=<?php echo $values["item_id"];?>">
							
							<span class="text-danger">Remove</span></a></h4></td>
							</tr>
						<?php
							$total=$total+($values["item_quantity"]*$values["item_price"]);}}
							
						?>
						
						<tr>
						<td colspan="3" style="align:right"><h3>Total</h3></td>
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
    

</body>
</html>

<?php $conn->close();?>
