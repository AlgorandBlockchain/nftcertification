<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$id = $_POST['member_id'];
	$level = $_POST['editlevel'];
	$nama_sekolah = $_POST['editnama_sekolah'];
	$jurusan = $_POST['editjurusan'];
	$thna = $_POST['editthna'];
	$thnb = $_POST['editthnb'];

	$sql = "UPDATE tformal_edu SET level = '$level', nama_sekolah = '$nama_sekolah',
	 			jurusan = '$jurusan', thna = '$thna', thnb = '$thnb' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Update";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while update the formal education information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}
