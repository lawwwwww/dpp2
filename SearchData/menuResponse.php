<?php
	//include connection file 
	include_once("connectdb.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();
	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$menuCls = new Menu($connString);
	switch($action) {
	 case 'add':
		$menuCls->insertMenu($params);
	 break;
	 case 'edit':
		$menuCls->updateMenu($params);
	 break;
	 case 'delete':
		$menuCls->deleteMenu($params);
	 break;
	 default:
	 $menuCls->getMenu($params);
	 return;
	}
	
	class Menu {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getMenu($params) {
		
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
			$where .=" ( foodcode LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR dishname LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR description LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR price LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `menutable` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot menu data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch menu data");
		
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
	
	function insertMenu($params) {
		$data = array();
		$sql = "INSERT INTO `menutable` (dishname, description, price) VALUES('" . $params["dishname"] . "', '" . $params["description"] . "','" . $params["price"] . "');  ";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to insert the data");
		
	}
	
	function updateMenu($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "Update `menutable` set dishname = '" . $params["edit_dishname"] . "', description='" . $params["edit_description"]."', price='" . $params["edit_price"] . "' WHERE foodcode='".$_POST["edit_id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error updating the record");
	}
	
	function deleteMenu($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "DELETE FROM 'menutable' WHERE dishname='".$_POST["del_dishname"]."'";
		echo $result = mysqli_query($this->conn, $sql) or die("error deleting the record");
	}
}
?>

