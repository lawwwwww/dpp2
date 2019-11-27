<?php
session_start();

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->email = isset($_GET['email']) ? $_GET['email'] : die();
$user->password =(isset($_GET['password']) ? $_GET['password'] : die());
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
 $user_arr=array
 (
 "empid"=>$row['empid'],
 "role"=>$row['role'],
 );
 
 if($row['role']=='Admin')
   {   header ('Location: ../../../mainadmin.php');
   } 
   
   elseif($row['role']=='Staff')
   {  
	
	$_SESSION['id']=$row['empid'];
	header('Location:  ../../../cook.php');
	}
   
   /* $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "empid" => $row['empid'],
        "email" => $row['email'],
		print "<a href='http://localhost/dpp2/cook.php?action=addemp&value=".$row['empid']."'>Success! Go to Tables</a>",
	);	*/
		
}
else{
	?><script>
	alert("Invalid email or Password");
	window.location.href = "../../../LoginRegister";</script><?php
	
}
?>
