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
	 case 'edit':
		$tbCls->updateTables($params);
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
			$where .=" ( tableno LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR servestatus LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR reservedate LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR reservetime LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR availability LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR amt LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `tablestable` ";
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
		$sql = "INSERT INTO `tablestable` (servestatus, reservedate, reservetime, availability, amt) VALUES('" . $params["servestatus"] . "', '" . $params["reservedate"] . "', '" . $params["reservetime"] . "', '" . $params["availability"] . "','" . $params["amt"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert the data");
	}
	
	function updateTables($params) {
		$data = array();;
		$sql = "Update `tablestable` set servestatus='" . $params["edit_servestatus"] . "', reservedate='" . $params["edit_reservedate"] . "', reservetime='" . $params["edit_reservetime"] . "', availability='" . $params["edit_availability"] . "', amt='" . $params["edit_amt"] . "';
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert the data");
	}
	
	function deleteTables($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "DELETE FROM tablestable WHERE tableno ='".$_POST["delete_id"]."'";
		echo $result = mysqli_query($this->conn, $sql) or die("error deleting the record");
	}
}
?>

