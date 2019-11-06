<?php

// Start session
session_start();

// Get session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

// Load pagination class
require_once 'PaginationClass.php';

// Load and initialize database class
require_once 'DBclass.php';
$db = new DB();

// Page offset and limit
$perPageLimit = 2;
$offset = !empty($_GET['page'])?(($_GET['page']-1)*$perPageLimit):0;

// Get search keyword
$searchKeyword = !empty($_GET['sq'])?$_GET['sq']:'';
$searchStr = !empty($searchKeyword)?'?sq='.$searchKeyword:'';

// Search DB query
$searchArr = '';
if(!empty($searchKeyword)){
    $searchArr = array(
        'foodcode' => $searchKeyword,
        'dishname' => $searchKeyword,
        'price' => $searchKeyword,
        'category' => $searchKeyword
    );
}

// Get count of the users
$con = array(
    'like_or' => $searchArr,
    'return_type' => 'count'
);
$rowCount = $db->getRows('foodcode', $con);

// Initialize pagination class
$pagConfig = array(
    'baseURL' => 'index.php'.$searchStr,   //<-----------here need to change name--->
    'totalRows' => $rowCount,
    'perPage' => $perPageLimit
);
$pagination = new Pagination($pagConfig);

// Get users from database
$con = array(
    'like_or' => $searchArr,
    'start' => $offset,
    'limit' => $perPageLimit,
    'order_by' => 'id DESC',
);
$users = $db->getRows('foodcode', $con);

?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="alert alert-success"><?php echo $statusMsg; ?></div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="alert alert-danger"><?php echo $statusMsg; ?></div>
<?php } ?>

<div class="row">
    <div class="col-md-12 search-panel">
        <!-- Search form -->
        <form>
        <div class="input-group">
            <input type="text" name="sq" class="form-control" placeholder="Search by keyword..." value="<?php echo $searchKeyword; ?>">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
        </form>
        
        <!-- Add link -->
        <span class="pull-right">
            <a href="addEdit.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New Record</a>
        </span>
    </div>
    
    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead>
			<tr>
				<th>Food Code</th>
				<th>Dish Name</th>
				<th>Category</th>
				<th>Price</th>
			</tr>
		</thead>
        <tbody>
            <?php
            if(!empty($foodcode)){ $count = 0; 
                foreach($foodcode as $fcode){ $count++;
            ?>
            <tr>
                <td><?php echo '#'.$count; ?></td>
                <td><?php echo $fcode['name']; ?></td>
                <td><?php echo $fcode['email']; ?></td>
                <td><?php echo $fcode['phone']; ?></td>
                <td>
                    <a href="addEdit.php?id=<?php echo $user['id']; ?>" class="glyphicon glyphicon-edit"></a>
                    <a href="userAction.php?action_type=delete&id=<?php echo $user['id']; ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="5">No user(s) found......</td></tr>
            <?php } ?>
        </tbody>
    </table>
    
    <!-- Display pagination links -->
    <?php echo $pagination->createLinks(); ?>
</div>