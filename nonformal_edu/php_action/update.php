<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$kegiatan = $_POST['editkegiatan'];
	$thna = $_POST['editthna'];
	$thnb = $_POST['editthnb'];

	$sql = "UPDATE tnonformal_edu SET kegiatan = '$kegiatan', thna = '$thna', thnb = '$thnb' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Update";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while update the non formal education information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}
