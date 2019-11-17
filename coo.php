<?php
				if(isset($_GET['tableno']))
				{
					$tabno=$_GET['tableno'];
					setcookie("taba",$tabno);
				}
				
				if(isset($_GET['empid']))
				{
					$empid=$_GET['empid'];
					setcookie("empa",$empid);
				}


			header ('Location: menu.php');
?>