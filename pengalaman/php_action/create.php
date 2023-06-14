<?php

require_once 'db_connect.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$bekerja_di = $_POST['bekerja_di'];
	$thna = $_POST['thna'];
	$thnb = $_POST['thnb'];
	$status_kerja = $_POST['status_kerja'];
	$posisi = $_POST['posisi'];
	$uraian_pekerjaan = $_POST['uraian_pekerjaan'];
	$userid = $_POST['userid'];

	$sql = "INSERT INTO tpengalaman (bekerja_di, thna, thnb, status_kerja, posisi, uraian_pekerjaan, userid) VALUES
					('$bekerja_di', '$thna', '$thnb', '$status_kerja', '$posisi', '$uraian_pekerjaan', '$userid')";
	$query = $connect->query($sql);

	if($query === TRUE) {
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";
	} else {
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the job experience information";
	}

	// close the database connection
	$connect->close();

	echo json_encode($validator);

}
