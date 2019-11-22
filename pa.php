<?php
						
						$conn=mysqli_connect("localhost","root","","cafedb");
							$oo="DELETE FROM ordertable where tableno=$_COOKIE[taba]";
							mysqli_query($conn,$oo);
							
							$pp="UPDATE tablestable set servestatus='no',availability='yes' where tableno=$_COOKIE[taba]";
							mysqli_query($conn,$pp);
							
							
							header('Location: main.php');
							?>