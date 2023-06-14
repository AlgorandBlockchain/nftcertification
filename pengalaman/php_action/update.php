<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$editbekerja_di = $_POST['editbekerja_di'];
	$editthna = $_POST['editthna'];
	$editthnb = $_POST['editthnb'];
	$editstatus_kerja = $_POST['editstatus_kerja'];
	$editposisi = $_POST['editposisi'];
	$edituraian_pekerjaan = $_POST['edituraian_pekerjaan'];

	$sql = "UPDATE tpengalaman SET bekerja_di = '$editbekerja_di', thna = '$editthna',
	 				thnb = '$editthnb', status_kerja = '$editstatus_kerja',
					posisi = '$editposisi', uraian_pekerjaan = '$edituraian_pekerjaan' WHERE id = $id";
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
