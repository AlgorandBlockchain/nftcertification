<?php

require_once 'db_connect.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];

$sql = "DELETE FROM tformal_edu WHERE id = {$memberId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the formal education information';
}

// close database connection
$connect->close();

echo json_encode($output);
