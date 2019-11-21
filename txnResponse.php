
<?php
	//include connection file 
	include_once("connectdb.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$cls = new Data($connString);

	switch($action) {
	 /*case 'add':
		$cls->insertData($params);
	 break;
	 case 'edit':
		$cls->updateData($params);
	 break;
	 case 'delete':
		$cls->deleteData($params);
	 break;*/
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
			$where .=" ( transactionid LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR orderid LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR datetime LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR qty LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR foodcode LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR dishname LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR amt LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR balance LIKE '".$params['searchPhrase']."%' )";
	   }
	   
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}

	   // getting total number records without any search
		$sql = "SELECT * FROM `paymenttable` ";
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

	/*function insertData($params) {
		$data = array();
		$sql = "INSERT INTO `menutable` (dishname, description, price, img) VALUES('" . $params["dishname"] . "', '" . $params["description"] . "', '" . $params["price"] . "', '" . $params["img"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql);
	}

	function updateData($params) {
		$data = array();
		
		$sql = "Update `menutable` set dishname='" . $params["edit_dishname"]."', description = '" . $params["edit_desc"] . "', price='" . $params["edit_price"] . "', img = '" . $params["edit_img"] . "' WHERE foodcode ='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql);
	}

	function deleteData($params) {
		$data = array();
		
		$sql = "delete from `menutable` WHERE foodcode='".$params["foodcode"]."'";
		
		echo $result = mysqli_query($this->conn, $sql);
	}*/
}
?>
	