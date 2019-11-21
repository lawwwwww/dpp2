
function showpayment()
{
	var about = ['<a href="showTxn.php">TRANSACTION RECORDS</a></br>', '<a href="transactionlist.php">TRANSACTION LIST</a></br>', '<a href="transactionLog.php">TRANSACTION LOG</a></br>','<a href="orderlist.php">ORDER LIST</a></br>'];
	document.getElementById("about").innerHTML = about;
}	


function showmanage()
{
	var manage = ['<a href="manageMenu.php">MANAGE MENU</a></br>', '<a href="manageTables.php">MANAGE TABLE</a></br>', '<a href="showEmp.php">MANAGE EMPLOYEE</a></br>'];
	document.getElementById("manage").innerHTML = manage;
}	
