<?php
				
				if(isset($_GET["action"]))
				{
					if($_GET["action"]=="addemp")
					{
						$ee=$_GET["value"];
						setcookie("emppa",$ee);
					}
				}
		

			header ('Location: main.php');
?>