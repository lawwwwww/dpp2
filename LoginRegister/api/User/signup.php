<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->email = $_POST['email'];
$user->password =($_POST['password']);
$user->role = $_POST['role'];
$user->hiredate = date('Y-m-d H:i:s');

 
// create the user
if($user->signup()){
    ?><script>
	alert("Succesfully signed up! Please sign in");
	window.location.href = "../../../LoginRegister";</script><?php
}
else{
    ?><script>
	alert("This email already exists!");
	window.location.href = "../../../LoginRegister";</script><?php
}
print_r(json_encode($user_arr));
?>