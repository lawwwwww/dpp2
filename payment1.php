<?php

	
				$conn=mysqli_connect("localhost","root","","cafedb");
					global $tabpay;
					if($conn->connect_error)
					{
						die("Connection failed:".$conn->connect_error);
					}
				/*
				if(isset($_GET["transactionid"]))
				{
					$transid=mysqli_real_escape_string($conn,$_GET['transactionid']);
				}*/				
				
					if(isset($_POST["add_pay"]))
					{
						$taba=$_COOKIE['taba'];
					
					$pay="INSERT INTO paymenttable(orderid,datetime,qty,foodcode,dishname,amt) (SELECT orderid,datetime,qty,foodcode,dishname,amt FROM ordertable where tableno=$taba)";
					mysqli_query($conn,$pay);
					
					}
					/*
					if(isset($_POST["amount"]))
					{
						
						$balance = ($total - $_POST["amount"]);
						echo $balance;
					}*/
				
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
			<li><a href="LoginRegister">LOGOUT</a></li>
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
						<h2 style="margin-left:32px; margin-top:50px;"> Payment</h2>
						
							<table class="ordertable">
							<tr>
							<td><h3>Dishname</h3></td>
							<td><h3>Quantity</h3></td>
							<td><h3>Price</h3></td>
							<td><h3>Total</h3></td>
							
							</tr>
							
	<?php
	 
	 $total=0;
		
	
				$sql="SELECT * from ordertable where tableno=$_COOKIE[taba] ORDER BY orderid ASC";	
				$resultt=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($resultt)>0)
					{	while($row=mysqli_fetch_array($resultt))
						{	
							?>
							<tr>
							<td><h4>
							<?php echo $row["dishname"];?></h4></td>
							
							<form method="post" action="payment1.php?action=add&oid=<?php echo $row["orderid"];?>&tbleno=<?php echo $row["tableno"];?>">
							<td style="text-align:center"><h4>
							<?php echo $row["qty"];?>
							</h4></td>
							</form>
							<td><h4>RM<?php echo $row["amt"];?></h4></td>
							
							<td style="text-align:center" ><h4>RM<?php echo number_format($row["amt"],2);?></h4></td>
							
							</tr>
							
					    <?php
							$total=$total+($row["qty"]*$row["amt"]);}}
							
						?>
					
						<tr>
						<td colspan="3"><h3>Total</h3></td>
						<td ><h3>RM<?php echo number_format($total,2);?></h3></td>
					</tr></table>
					<form method="post"  style="margin-left:35px; margin-top:20px;font-size:18px;">
					Amount Receive:  <input type="text" name="amount" id = "amountt" placeholder="Enter Amount"  ></form>
						<?php 
						error_reporting(0);
						
						$balance = ($_POST["amount"]-$total);?>
							<p style="margin-left:35px; margin-top:20px;font-size:18px;">Balance:<?php echo $balance;?></p>
							
							</br>
							
							</form>
							<form method="post" action="pa.php">
							<input type="submit" value="Complete Transaction" name="paynow" style="margin-left:35px;margin-top:0px;" class="btn btn-success"/>
							
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
