
function showpayment()
{
	var about = ['<a href="transactionlist.php">TRANSACTION LIST</a><a href="transactionLog.php">TRANSACTION LOG</a><a href="orderlist.php">ORDER LIST</a>'];
	document.getElementById("about").innerHTML = about;
}	


function showmanage()
{
	var manage = ['<a href="manageMenu.php">MANAGE MENU</a><a href="manageTables.php">MANAGE TABLE</a><a href="manageEmp.php">MANAGE EMPLOYEE</a>'];
	document.getElementById("manage").innerHTML = manage;
}	
