<?php
	//include connection file 
	include_once("connectdb.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();
	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$tbCls = new Tables($connString);
	switch($action) {
	 case 'add':
		$tbCls->insertTables($params);
	 break;
	 case 'delete':
		$tbCls->deleteTables($params);
	 break;
	 default:
	 $tbCls->getTables($params);
	 return;
	}
	
	class Tables {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getTables($params) {
		
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
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tables data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch tables data");
		
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
	
	function insertTables($params) {
		$data = array();;
		$sql = "INSERT INTO `employeetable` (servestatus, reservedate, availability, amt) VALUES('" . $params["servestatus"] . "', '" . $params["reservedate"] . "','" . $params["availability"] . "','" . $params["amt"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert the data");
	}
	
		function updateTables($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `employeetable` set dishname = '" . $params["edit_dishname"] . "', description='" . $params["edit_description"]."', price='" . $params["edit_price"] . "' WHERE foodcode='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error updating the record");
	} 
	
	function deleteTables($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "DELETE FROM employeetable WHERE tableno ='".$_POST["delete_id"]."'";
		echo $result = mysqli_query($this->conn, $sql) or die("error deleting the record");
	}
}
?>

