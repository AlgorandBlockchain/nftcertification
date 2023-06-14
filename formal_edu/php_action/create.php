<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$level = $_POST['level'];
	$nama_sekolah = $_POST['nama_sekolah'];
	$jurusan = $_POST['jurusan'];
	$thna = $_POST['thna'];
	$thnb = $_POST['thnb'];
	$userid = $_POST['userid'];

	$sql = "INSERT INTO tformal_edu (level, nama_sekolah, jurusan, thna, thnb, userid) VALUES ('$level', '$nama_sekolah', '$jurusan', '$thna', '$thnb', '$userid')";
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
