         <?php 
		 
					$conn=mysqli_connect("localhost","root","","cafedb");
					global $tabno;
					
					//$tabno=$_SESSION['tableno'];
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
				
				if(isset($_GET['tableno']))
				{
					$tabno=mysqli_real_escape_string($conn,$_GET['tableno']);
					
				}
			
				if(isset($_POST["add_to_cart"]))
				{
					$sqll="SELECT * FROM ordertable";
					$resultt=mysqli_query($conn,$sqll);
					
					if($_POST['hidtabno']!=0)
					{
						$add="INSERT INTO ordertable (empid,amt,qty,tableno,foodcode,dishname)VALUES(2,'$_POST[hidden_price]','$_POST[quantity]','$_POST[hidtabno]','$_GET[id]','$_POST[hidden_name]')";
						mysqli_query($conn,$add);	
						$tab="UPDATE tablestable set servestatus='yes',availability='no' where tableno=$_POST[hidtabno]";
						mysqli_query($conn,$tab);
										
					}
					else
					{	
						$sql="SELECT * from ordertable ORDER BY orderid";	
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
					{	
						while($row=mysqli_fetch_array($result))
							{
								$t=$row["tableno"];	
							}	
					$upd="INSERT INTO ordertable (empid,amt,qty,tableno,foodcode,dishname)VALUES(2,'$_POST[hidden_price]','$_POST[quantity]','$t','$_GET[id]','$_POST[hidden_name]')";
						mysqli_query($conn,$upd);
											
					}

							
						}
				}
					
				if(isset($_GET["action"]))
				{
					if($_GET["action"]=="delete")
						{
						$del="DELETE FROM ordertable where orderid=$_GET[id]";
						mysqli_query($conn,$del);
						echo'<script>alert("Are u sure u want to delete")</script>';

						$sql="SELECT * from ordertable where tableno=$_GET[tableno] ORDER BY orderid";	
						$result=mysqli_query($conn,$sql);
						
						if(mysqli_num_rows($result)<1)
					{
						$updt="UPDATE tablestable set servestatus='no',availability='yes' where tableno=$_GET[tableno]";
						mysqli_query($conn,$updt);
					}	
						}
						
					}
					if(isset($_POST["quantity2"]))
					{
						if($_POST["quantity2"]==0)
						{
							
							echo'<script>alert("invalid number")</script>';
						}
						else
						{
						$updq="UPDATE ordertable set qty=$_POST[quantity2] where orderid=$_GET[oid]";
						mysqli_query($conn,$updq);
						}				
					}
					if(isset($_GET["action"]))
				{
					if($_GET["action"]=="clear")
						{
						$del="DELETE FROM ordertable where tableno=$_GET[tableno]";
						mysqli_query($conn,$del);
						echo'<script>alert("Are u sure u want to delete")</script>';

						$updt="UPDATE tablestable set servestatus='no',availability='yes' where tableno=$_GET[tableno]";
						mysqli_query($conn,$updt);
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
    
    <!-- Main content -->
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
			
                <div class="box">
                    <!-- /.box-header -->
								<br/>
                           
        <?php			
		$sql="SELECT * from menutable ORDER BY foodcode ASC";	
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
							<input type="hidden" name="hidtabno" value="<?php echo $tabno?>;"/>
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
						<h3>Order Details</h3>
						
							<table class="showtable"">
							<tr>
							<td><h3>Dishname</h3></td>
							<td><h3>Quantity</h3></td>
							<td><h3>Price</h3></td>
							<td><h3>Total</h3></td>
							<td><h3>Action</h3></td>
							</tr>
							
	<?php
		$total=0;
							
			if($tabno!=0)
		{
				$ta=$tabno;						
		}
			else
		{
			$sqll="SELECT * from ordertable ORDER BY orderid";	
			$resultt=mysqli_query($conn,$sqll);
			if(mysqli_num_rows($resultt)>0)
			{	
				while($row=mysqli_fetch_array($resultt))
					{
						$t=$row["tableno"];
						$ta=$t;						
					}
			}
			else{
				$ta="";
				}
			
							
		}
				$sql="SELECT * from ordertable where tableno=$ta ORDER BY orderid ASC";	
				$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)>0)
					{	while($row=mysqli_fetch_array($result))
						{	
							?>
							<tr>
							<td><h4>
							<?php echo $row["dishname"];?></h4></td>
							
							<form method="post" action="menu.php?action=add&oid=<?php echo $row["orderid"];?>&tbleno=<?php echo $row["tableno"];?>">
							<td style="text-align:center"><h4>
							<input type="text" name="quantity2" value="<?php echo $row["qty"];?>" style="width:15%"/>
							</h4></td>
							</form>
							<td><h4>RM<?php echo $row["amt"];?></h4></td>
							
							<td style="text-align:center"><h4>RM<?php echo number_format($row["qty"]*$row["amt"],2);?></h4></td>
							
							<td><h4>
							<a href="menu.php?action=delete&id=<?php echo $row["orderid"];?>&tableno=<?php echo $row["tableno"];?>">
							
							<span class="text-danger">Remove</span></a></h4></td>
							</tr>
						<?php
							$total=$total+($row["qty"]*$row["amt"]);}}
							
						?>
						
						<tr>
						<td colspan="3"><h3>Total</h3></td>
						<td><h3>RM<?php echo number_format($total,2);?></h3></td>
						<td style="text-align:center"><h3><a href="menu.php?action=clear&id=<?php echo $row["orderid"];?>&tableno=<?php echo $ta;?>">
							<span class="text-danger">Clear</span></a></h3></td>
						</tr></table>
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
