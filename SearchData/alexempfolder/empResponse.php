<?php
	//include connection file 
	include_once("connectdb.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$cls = new Data($connString);

	switch($action) {
	 case 'add':
		$cls->insertData($params);
	 break;
	 case 'edit':
		$cls->updateData($params);
	 break;
	 case 'delete':
		$cls->deleteData($params);
	 break;
	 default:
	 $cls->getData($params);
	 return;
	}
	
	class Data {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getData($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" (  empid LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR name LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR address LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR contactinfo LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR role LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR gender LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR email LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR password LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR hiredate LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `employeetable` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	
	function insertData($params) {
		$data = array();
		$sql = "INSERT INTO `employeetable` (name, address, contactinfo, role, gender, email, password, hiredate) VALUES('" . $params["name"] . "', '" . $params["address"] . "','" . $params["contactinfo"] . "', '" . $params["address"] . "', '" . $params["role"] . "', '" . $params["gender"] . "', '" . $params["email"] . "', '" . $params["password"] . "','"  . $params["hiredate"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql);
	}
	
		function updateData($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `employeetable` set name = '" . $params["edit_name"] . "', address='" . $params["edit_address"]."', contactinfo='" . $params["edit_contactinfo"] . "', role='" . $params["edit_role"]. "', gender='" . $params["edit_gender"]. "', email='" . $params["edit_email"]. "', password='" . $params["edit_password"]. "', hiredate='" . $params["edit_hiredate"]. "' WHERE empid='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql);
	} 
	
	function deleteData($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `employeetable` WHERE empid='".$params["empid"]."'";
		echo $result = mysqli_query($this->conn, $sql);
	}
}
?>

