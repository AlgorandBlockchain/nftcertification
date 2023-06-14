<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$skill = $_POST['editSkill'];
	$category = $_POST['editCategory'];

	$sql = "UPDATE tmyskill SET skill = '$skill', category = '$category' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Update";		
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while update the skill information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}
