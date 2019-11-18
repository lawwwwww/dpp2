<?php

	
				$conn=mysqli_connect("localhost","root","","cafedb") or die();
				global $transid;
					//$transid=$_SESSION['transactionid'];
					
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
				
				if(isset($_GET["transactionid"]))
				{
					$transid=mysqli_real_escape_string($conn,$_GET['transactionid']);
				}			
				
					if(isset($_POST["add_pay"]))
					{
					$sqll="SELECT * FROM paymenttable";
					$resultt=mysqli_query($conn,$sqll);
					
					$pay="INSERT INTO paymenttable(orderid,datetime,qty,foodcode,dishname,amt) (SELECT orderid,datetime,qty,foodcode,dishname,amt FROM ordertable where tableno=$_POST[tabpay])";
					mysqli_query($conn,$pay);
					}
					else
					{
						$sqql="SELECT * fom paymenttable ORDER BY transactionid";
						$result=mysqli_query($conn,$sqql);
				
						if(mysqli_num_rows($result)>0)
						{	
						while($row=mysqli_fetch_array($result))
					    	{
							   $tid=$row["transactionid"];						
						    }
						}
					}
					if(isset($_POST["amount"]))
					{
						
						$balance = ($_POST["price"] - $_POST["amount"]);
						echo $balance;
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
							<input type="hidden" name="hidtabno" value="<?php echo $tabno?>;"/>
							<input type="hidden" name="hidden_name" value="<?php echo $row["dishname"];?>"/>
							<input type="hidden" name="hidden_foodcode" value="<?php echo $row["foodcode"];?>"/>
							<br/>
							
							</form>
					</div></div>
					</section>
					<?php }}?>
					<div class="sidenav" >
						<br/>
						<h3> Payment</h3>
						
							<table class="showtable"">
							<tr>
							<td><h3>Dishname</h3></td>
							<td><h3>Quantity</h3></td>
							<td><h3>Price</h3></td>
							<td><h3>Total</h3></td>
							
							</tr>
							
	<?php
		
		
			if($transid!=0)
			{
				$t=$transid;
			}
			else
			{
				$sqql="SELECT * from paymenttable ORDER BY orderid";
				$result=mysqli_query($conn,$sqql);
				
				if(mysqli_num_rows($result)>0)
			{	
				while($row=mysqli_fetch_array($result))
					{
						$tid=$row["transactionid"];
						$t=$tid;						
					}
			}
			else{
				$t="";
				}
			}
				$sql="SELECT * from paymenttable ORDER BY orderid ASC";	
				$resultt=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($resultt)>0)
					{	while($row=mysqli_fetch_array($resultt))
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
							
							<td style="text-align:center" ><h4>RM<?php echo number_format($row["amt"],2);?></h4></td>
							
							</tr>
							
					<?php }}?>
					
						
						<tr>
						<td colspan="3"><h3>Total</h3></td>
						<td ><h3>RM<?php echo number_format($row["amt"],2);?></h3></td>
					</tr></table>
					<form method="post" action="payment1.php?action=get&id=<?php echo $row["transactionid"];?>&total=<?php echo $row["amt"];?>">
					Amount Receive:  <input type="text" name="amount" id = "amountt"></form>
						
							<p>Balance:</p><?php echo $row["balance"];?>
							
							<br>
							
							<a href="showtable.php">
							<button type="button" >Pay Now</button>
							</a>
							
							</form>
						
						
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