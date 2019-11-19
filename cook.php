<?php
				session_start();
				$ee=$_SESSION['id'];
				setcookie("emppa",$ee);
					
		

			header ('Location: main.php');
?>