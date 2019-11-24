
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
			$where .=" ( tableno LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR servestatus LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR reservedate LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR reservetime LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR reservename LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR availability LIKE '".$params['searchPhrase']."%' )";
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
		$sql = "INSERT INTO `tablestable` (servestatus, reservedate, reservetime, reservename, availability) VALUES('" . $params["servestatus"] . "', '" . $params["reservedate"] . "', '" . $params["reservetime"] . "', '" . $params["reservename"] . "', '" . $params["availability"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert data");
	}

	function updateData($params) {
		$data = array();
		
		$sql = "Update `tablestable` set servestatus='" . $params["edit_status"]."', reservedate = '" . $params["edit_date"] . "', reservetime='" . $params["edit_time"] . "', reservename='" . $params["edit_name"] . "', availability = '" . $params["edit_ava"] . "' WHERE tableno ='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to update data");
	}
	
	function deleteData($params) {
		$data = array();
		$sql = "delete from `tablestable` WHERE tableno='".$params["tableno"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete data");
	}
}
?>
	