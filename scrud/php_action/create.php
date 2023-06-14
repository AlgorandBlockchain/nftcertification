<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$skill = $_POST['skill'];
	$category = $_POST['category'];
	$userid = $_POST['userid'];

	$sql = "INSERT INTO tmyskill (skill, category, userid) VALUES ('$skill', '$category', '$userid')";
	$query = $connect->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}
