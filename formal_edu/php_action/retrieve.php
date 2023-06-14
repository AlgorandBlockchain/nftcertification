<?php

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "SELECT * FROM tformal_edu where userid = ".$_GET['id']."";
$query = $connect->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {

	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
	  </ul>
	</div>';

	$output['data'][] = array(
		$x,
		$row['level'],
		$row['nama_sekolah'],
		$row['thna'],
		$row['thnb'],
		$row['jurusan'],
		$actionButton
	);
	$x++;
}

// database connection close
$connect->close();

echo json_encode($output);
